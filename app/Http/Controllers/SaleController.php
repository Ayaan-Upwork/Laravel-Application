<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Sale;
use App\Models\SaleFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    
public function index()
    {
        // $leads = Lead::all();

        // return  view('lead', compact('leads')); 
        $leads = Sale::with('lead')->get(); // Load user data along with leads
        return view('sale', compact('leads'));       
    }
public function store(Request $request)
    {
        $request->validate([           
            'comment' => 'sometimes',           
        ]);

        $user = Sale::create([     
            'lead_id' => $request->user_id,
            'comment' => $request->comment,
            'status' => 'Pending',
        ]);
        
    // Handle Multiple File Uploads if Files Exist
    if ($request->hasFile('files')) {
    //  dd($user->id);
    foreach ($request->file('files') as $file) {
        $filePath = $file->store('Sale/files', 'public'); // Store file
        SaleFile::create([
            'sale_id' => $user->id, // Associate with the created lead
            'file_path' => $filePath, // Save file path
        ]);
         }
                 } 
         return redirect()->route('user.lead.all')->with('success', 'Sale created successfully');
        // return response()->json(['message' => 'Sale created successfully', 'user' => $user], 201);
    }

public function updateStatus(Request $request)
    {
        $request->validate([
            'sale' => 'required|exists:sales,id',
            'status' => 'required|in:Pending,Sale,Rejected'
        ]);
    
        $lead = Sale::findOrFail($request->sale);
        $lead->status = $request->status;
        $lead->save();

        $lead = Lead::findOrFail($lead->lead_id);
        $lead->status = "Sale";
        $lead->save();

        // return redirect()->route('sale.all')->with('success', 'Sale created successfully');
        return response()->json(['message' => 'Status updated successfully!']);
    }
public function edit($id)
    {
    $lead = Sale::with('saleFiles')->findOrFail($id); // Fetch single lead with files
    return view('sale-view', compact('lead'));
    }

public function update(Request $request, $id)
    {
    // Validate incoming request
    $request->validate([
        'comment' => 'nullable|string',
        'files' => 'sometimes|array',
        'files.*' => 'file|mimes:jpg,jpeg,png,pdf,wav,mp3|max:2048', // File validation
    ]);

    // Find the lead by ID
    $lead = Sale::findOrFail($id);

    // Update the lead's details
    $lead->update([
       
        'comment' => $request->comment,
    ]);

    // Handle file uploads if files are provided
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('leads/files', 'public'); // Store file
            SaleFile::create([ // Associate files with the lead
                'lead_id' => $lead->id, 
                'file_path' => $filePath, 
            ]);
        }
    }

    // Redirect back with success message
 
    return redirect()->route('sale.all')->with('success', 'sale updated successfully');
 
    }



}
