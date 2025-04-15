<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CreateProduct extends Component
{
    use WithFileUploads;

    // Form fields
    public $name = '';
    public $description = '';
    public $unite = '';
    public $price = '';
    public $reference = '';
    public $quantity = '';
    public $status = 'Disponible';
    public $promotion = 0;
    public $promotion_value = 0;
    public $selectedCategory = '';
    public $selectedSubcategory = '';
    public $subsub_category_id = '';
    public $existing_images = [];
    public $images = [];
    
    // Messages
    public $message = '';
    public $error = '';

    /**
     * Validation rules
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'unite' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'reference' => 'required|string|max:100',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|in:Disponible,sur commande',
            'promotion' => 'required|in:0,1',
            'promotion_value' => 'nullable|numeric|min:0|max:100',
            'subsub_category_id' => 'nullable|exists:subsub_categories,id',
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'exists:images,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max per image
        ];
    }

    /**
     * Real-time validation on property updates
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);

        // Reset dependent dropdowns when parent changes
        if ($propertyName === 'selectedCategory') {
            $this->selectedSubcategory = '';
            $this->subsub_category_id = '';
        }
        if ($propertyName === 'selectedSubcategory') {
            $this->subsub_category_id = '';
        }
    }

    /**
     * Save the product
     */
    public function save()
    {
        $validated = $this->validate();

        try {
            // Create product
            $product = Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'unite' => $this->unite,
                'price' => $this->price,
                'reference' => $this->reference,
                'quantity' => $this->quantity,
                'status' => $this->status,
                'promotion' => $this->promotion,
                'promotion_value' => $this->promotion_value,
                'subsub_category_id' => $this->subsub_category_id,
            ]);

            // Log creation (optional, matches your original controller)
            Log::info("Product created with ID: {$product->id}");

            // Attach existing images
            if (!empty($this->existing_images)) {
                $product->images()->attach($this->existing_images);
                Log::info("Attached existing images to product ID {$product->id}: " . implode(', ', $this->existing_images));
            }

            // Handle new image uploads
            if ($this->images) {
                foreach ($this->images as $image) {
                    $path = $image->store('products', 'public');
                    $imageRecord = Image::create([
                        'image_path' => 'D/storage/' . $path, // Match your original controller's path
                    ]);
                    $product->images()->attach($imageRecord->id);
                    Log::info("Attached image {$imageRecord->id} to product {$product->id}");
                }
            }

            // Set success message and reset form
            $this->message = 'Product created successfully!';
            $this->error = '';
            $this->resetExcept('message');

            // Optional: Redirect to products index (uncomment if desired)
            // $this->dispatchBrowserEvent('redirect', ['url' => route('admin.products.index')]);
        } catch (\Exception $e) {
            $this->error = 'Failed to create product: ' . $e->getMessage();
            $this->message = '';
            Log::error("Failed to create product: {$e->getMessage()}");
        }
    }

    /**
     * Render the component
     */
    public function render()
    {
        $categories = Category::with(['subcategories.subsubcategories'])->get();
        $existingImages = Image::all();

        return view('livewire.create-product', [
            'categories' => $categories,
            'existingImages' => $existingImages,
        ]);
    }
}