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

    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'numeric']
        ]);

        if(!$this->categoryRepository->find($request->id))
        {
            return $this->respondNotFound('دسته بندی وجود ندارد');
        }

        if(!$this->categoryRepository->delete($request->id))
        {
            return $this->respondInternalError('دسته بندی حذف نشد ');
        }

        return $this->respondSuccess('دسته بندی حذف شد', []);

    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'numeric'],
            'name' => 'required|string|min:2|max:255',
            'slug' => 'required|string|min:2|max:255',
        ]);

        try {
            $updatedUser = $this->categoryRepository->update($request->id, [
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
        } catch (\Throwable $th) {
            return $this->respondInternalError('دسته بندی ایجار نشد');
        }  

        return $this->respondSuccess('دسته بندی  بروز رسانی شد', [
            'name' => $updatedUser->getName(),
            'slug' => $updatedUser->getSlug()
        ]);

    }

}