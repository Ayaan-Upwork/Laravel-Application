<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\LeadFile;
use App\Models\Sale;
use App\Models\SaleFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use Illuminate\Validation\ValidationException;
class LeadController extends Controller
{
    //

    public function index()
    {
        // $leads = Lead::all();

        // return  view('lead', compact('leads')); 
        $leads = Lead::with('user')->get(); // Load user data along with leads
return view('lead', compact('leads'));       
    }

  public function userlead()
    {
        // $leads = Lead::all();

        // return  view('lead', compact('leads')); 
        $leads = Lead::where('user_id' ,Auth::user()->id)->orWhere('clouser' ,Auth::user()->id)->get(); // Load user data along with leads
        $sales = [];
        foreach ($leads as $lead) {
            $sales[$lead->id] = Sale::with('saleFiles')->where('lead_id', $lead->id)->get(); // Get sales for the current lead
        }

        return view('leaduser', compact('leads','sales'));       
    }
    public function userleada()
    {
        $leads = Lead::where('user_id' ,Auth::user()->id)->orWhere('clouser' ,Auth::user()->id)->get(); // Load user data along with leads
        $sales = [];
        foreach ($leads as $lead) {
            $sales[$lead->id] = Sale::with('saleFiles')->where('lead_id', $lead->id)->get(); // Get sales for the current lead
        }
        return view('leadapproved', compact('leads','sales'));       
    }


    public function userleads()
    {
    $leads = Lead::where('user_id' ,Auth::user()->id)->orWhere('clouser' ,Auth::user()->id)->get(); // Load user data along with leads
        $sales = [];
        foreach ($leads as $lead) {
            $sales[$lead->id] = Sale::with('saleFiles')->where('lead_id', $lead->id)->get(); // Get sales for the current lead
        }
        return view('leadsale', compact('leads','sales'));       
    }




    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required', // Ensure the user exists
            'name' => 'required',
            'clouser' => 'sometimes',
            'business_name' => 'sometimes',
            'phone' => 'required|unique:leads,phone', // Allows numbers, +, and spaces
            'address' => 'sometimes',
            'zip' => 'sometimes', // Optional but should be valid if present
            'state' => 'sometimes',
            'country' => 'sometimes',
            'comment' => 'sometimes',
           
        ]);
        $clouser = $request->clouser ?: $request->user_id;
        $user = Lead::create([
            'user_id' => $request->user_id, // Ensure it's linked to the user
            'name' => $request->name,
            'clouser' => $clouser,
            'business_name' => $request->business_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'zip' => $request->zip,
            'state' => $request->state,
            'country' => $request->country,
            'comment' => $request->comment,
            'status' => 'Pending',
        ]);
        
    // Handle Multiple File Uploads if Files Exist
if ($request->hasFile('files')) {

    // dd($request->file('files'));
    foreach ($request->file('files') as $file) {
        $filePath = $file->store('leads/files', 'public'); // Store file
        LeadFile::create([
            'lead_id' => $user->id, // Associate with the created lead
            'file_path' => $filePath, // Save file path
        ]);
    }
}

if ( Auth::user()->role =="agent") {
    return redirect()->route('user.lead.all')->with('success', 'Lead updated successfully');
 }else{
    return redirect()->route('lead.all')->with('success', 'Lead updated successfully');
 }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'status' => 'required|in:Pending,Approved,Rejected'
        ]);
    
        $lead = Lead::findOrFail($request->lead_id);
        $lead->status = $request->status;
        $lead->save();
    
        return response()->json(['message' => 'Status updated successfully!']);
    }
    public function edit($id)
{
    $lead = Lead::with('clousers')->with('leadFiles')->findOrFail($id); // Fetch single lead with files
    return view('lead-view', compact('lead'));
}

public function update(Request $request, $id)
{
    // Validate incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'business_name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'zip' => 'nullable|string|max:20',
        'state' => 'nullable|string|max:100',
        'country' => 'nullable|string|max:100',
        'comment' => 'nullable|string',
        'files' => 'sometimes|array',
        'files.*' => 'file|mimes:jpg,jpeg,png,pdf,wav,mp3|max:2048', // File validation
    ]);

    // Find the lead by ID
    $lead = Lead::findOrFail($id);

    // Update the lead's details
    $lead->update([
        'name' => $request->name,
        'business_name' => $request->business_name,
        'phone' => $request->phone,
        'address' => $request->address,
        'zip' => $request->zip,
        'state' => $request->state,
        'country' => $request->country,
        'comment' => $request->comment,
    ]);

    // Handle file uploads if files are provided
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('leads/files', 'public'); // Store file
            LeadFile::create([ // Associate files with the lead
                'lead_id' => $lead->id, 
                'file_path' => $filePath, 
            ]);
        }
    }
    if (   Auth::user()->role =="agent") {
        return redirect()->route('user.lead.all')->with('success', 'Lead updated successfully');
     }else{
        return redirect()->route('lead.all')->with('success', 'Lead updated successfully');
     }
    // Redirect back with success message
  
}

}
