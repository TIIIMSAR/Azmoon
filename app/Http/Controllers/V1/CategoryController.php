<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Contract\ApiController;
use App\Repositories\Contracts\CategoryRepositorieInterface;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function __construct(private CategoryRepositorieInterface $categoryRepository)
    {
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'slug' => 'required|string|min:2|max:255',
        ]);

        $createdCategory = $this->categoryRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return $this->respondCreated('دسته بندی ایجاد شد', [
            'name' => $createdCategory->getName(),
            'slug' => $createdCategory->getSlug(),
        ]);
    }

}