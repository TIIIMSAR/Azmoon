<?php 

namespace API\V1\Users;

use App\Repositories\Contracts\CategoryRepositorieInterface;
use Tests\TestCase;

class CategoriesTest extends TestCase
{   
    // public function setUp(): void
    // {
    //     parent::setUp();
    //     $this->artisan('migrate:refresh');
    // }

    public function test_ensure_we_can_create_a_new_category()
    {
        $newCategory =[            
        'name' => 'category___-1',
        'slug' => 'category_1',
        ];

        $response = $this->call('POST', 'api/v1/categories', $newCategory);

        $this->assertEquals(201, $response->getStatusCode());
        // $this->seeInDatabase('categories', $newCategory);
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'name',
                'slug',
      ]]);
    }

    public function test_ensure_we_can_delete_category()
    {
        $category = $this->createCategories()[0];
        
        $response = $this->call('DELETE', 'api/v1/categories', [
            'id' => (string)$category->getId() 
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }

    public function test_ensure_we_can_update_category()
    {
        $category = $this->createCategories()[0];

        $categoryDate = [
            'id' => (string)$category->getId(),
            'name' =>$category->getName() . 'updated',
            'slug' =>$category->getSlug() . '-updated',
        ];

        $response = $this->call('PUt', 'api/v1/categories', $categoryDate);

        $this->assertEquals(200, $response->getStatusCode());
        $this->seeInDatabase('categories', $categoryDate);
        $this->seeJsonStructure([
            'success',  
            'message',
            'data' => [
                'name',
                'slug'
            ],
        ]);


    }

    public function test_should_get_category()
    {
        $user = $this->createCategories(30);

        $pagesize = 3;
        $response = $this->call('GET', 'api/v1/categories', [
            'page' => 1,
            'pagesize' => $pagesize,
        ]);

        $data = json_decode($response->getContent(), true);

        $this->assertEquals($pagesize, count($data['data']));
        $this->assertEquals(200, $response->status());
        
        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }


    public function test_ensure_we_can_get_filered_categories()
    {
        $pagesize = 3;
        $categoryName = 'new-category';   
        $response = $this->call('GET', 'api/v1/categories', [
            'search' => $categoryName,
            'page' => 1,
            'pagesize' => $pagesize,
        ]);

        $data = json_decode($response->getContent(), true);
            foreach($data['data'] as $category)
                $this->assertEquals($category['slug'], $categoryName);

        $this->assertEquals(200, $response->status());
        
        $this->seeJsonStructure([
            'success',  
            'message',
            'data',
        ]);
    }

    private function createCategories(int $count = 1): array
    {
        $categoryRepository = $this->app->make(CategoryRepositorieInterface::class);

        $newCategory = [
            'name' => 'new category',
            'slug' => 'new category slug',
        ];

        $categories = [];

        foreach(range(0, $count) as $item)
        {
           $categories[] = $categoryRepository->create($newCategory);
        }

        return $categories;
        
    }
}