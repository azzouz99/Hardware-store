<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            'quantity' => 'nullable|integer|min:0',
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

        // Log creation
        Log::info("Product created with ID: {$product->id}");

        // Attach existing images
        if (!empty($this->existing_images)) {
            $product->images()->attach($this->existing_images);
            Log::info("Attached existing images to product ID {$product->id}: " . implode(', ', $this->existing_images));
        }

        // Handle new image uploads
        if (!empty($this->images) && is_array($this->images)) {
            foreach ($this->images as $image) {
                try {
                    // Generate a unique path for the image
                    $fileName = uniqid('product_') . '.' . $image->getClientOriginalExtension();
                    $path = 'products/' . now()->format('Y/m') . '/' . $fileName;

                    // Store the image in S3
                    $image->storePubliclyAs('products/' . now()->format('Y/m'), $fileName, 's3');

                    // Create the full S3 URL
                    $s3Url = config('filesystems.disks.s3.url');
                    $bucket = config('filesystems.disks.s3.bucket');
                    $region = config('filesystems.disks.s3.region');
                    
                    // Construct the complete S3 URL
                    $fullUrl = $s3Url 
                        ? rtrim($s3Url, '/') . '/' . $path
                        : "https://{$bucket}.s3.{$region}.amazonaws.com/{$path}";

                    // Create image record
                    $imageRecord = Image::create([
                        'image_path' => $fullUrl,
                    ]);

                    // Attach the image to the product
                    $product->images()->attach($imageRecord->id);

                    Log::info("Uploaded and attached new image to product ID {$product->id}: {$path}");
                } catch (\Exception $e) {
                    Log::error("Failed to upload image for product ID {$product->id}: {$e->getMessage()}");
                    continue;
                }
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