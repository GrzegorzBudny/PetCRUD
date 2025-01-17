<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Response\GetPetResponse;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Requests\CreatePetRequest;

class PetController extends Controller
{
    public function getPets(Request $request)
    {
        $status = $request->input('status', 'available');
        
        if (!in_array($status, ['available', 'sold', 'pending'])) {
            $status = 'available';
        }

        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
            'status' => $status,
        ]);

        if ($response->successful()) {
            return view('pets.index', [
                'pets' => $response->json(),
                'selectedStatus' => $status
            ]);
        }

        return response()->json(['error' => 'Unable to fetch pets'], 500);
    }

    public function findPetById($id)
    {
        if (!is_numeric($id)) {
            return redirect()->route('pets.index')->with('error', 'Invalid pet ID');
        }

        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");
    
        if ($response->successful()) {
            $pet = GetPetResponse::createFromApiResponse($response->json());
    
            return view('pets.show', ['pet' => $pet]);
        }
    
        return redirect()->route('pets.index')->with('error', 'Pet not found');
    }

    public function createForm()
    {
        return view('pets.create');
    }

    public function createPet(CreatePetRequest $request)
    {    
        $response = Http::post('https://petstore.swagger.io/v2/pet', [
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);
    
        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet added successfully!');
        }
    
        return back()->with('error', 'Unable to add pet');
    }
    
    public function editPet($id)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");
        
        if ($response->successful()) {
            $pet = $response->json();
            return view('pets.edit', ['pet' => $pet]);
        }

        return redirect()->route('pets.index')->with('error', 'Pet not found');
    }

    public function updatePet(UpdatePetRequest $request, $id)
    {
        $payload = $this->buildPayload($request, $id);
    
        $response = Http::put("https://petstore.swagger.io/v2/pet", $payload);
    
        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
        }
    
        return back()->with('error', 'Unable to update pet. Please try again later.');
    }

    private function buildPayload(UpdatePetRequest $request, $id)
    {
        return [
            'id' => (int) $id,
            'category' => [
                'id' => 0,
                'name' => 'default-category',
            ],
            'name' => $request->input('name'),
            'photoUrls' => ['https://example.com/default.jpg'],
            'tags' => [
                [
                    'id' => 0,
                    'name' => 'default-tag',
                ],
            ],
            'status' => $request->input('status'),
        ];
    }

    public function destroyPet($id)
    {
        $response = Http::delete("https://petstore.swagger.io/v2/pet/$id");

        if ($response->successful()) {
            return redirect()->route('pets.index')->with('success', 'Pet deleted successfully!');
        }

        return back()->with('error', 'Unable to delete pet');
    }
}
