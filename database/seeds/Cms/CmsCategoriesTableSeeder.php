<?php

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CmsCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $blog_categories = [
            [
                'id' => 1,
                'title' => 'Cms',
                'children' => [
                    ['id' => 2, 'title' => 'Cms features'],
                    ['id' => 3, 'title' => 'How to use it'],
                    ['id' => 4, 'title' => 'Contribute'],
                    [
                        'id' => 5,
                        'title' => 'Cms author',
                        'children' => [
                            ['id' => 6, 'title' => 'CV'],
                        ],
                    ],
                ],
            ],
        ];

        $this->saveTree($blog_categories, null);
    }

    public function saveTree($categories, $parent)
    {
        $order = 0;
        foreach($categories as $category)
        {
            $order ++;
            $node = Category::updateOrCreate(
                ['id' => $category['id']],
                [
                    'title' => $category['title'],
                    'url' => Str::slug($category['title']),
                    'order' => $order,
                    'activated' => 1,
                    'google_index' => 1,
                ]
            );

            if(isset($parent)){
                $parent->appendNode($node);
            }
            if(isset($category['children'])){
                $this->saveTree($category['children'], $node);
            }
        }
    }

        // $node = new Category(['name' => 'root']);
        // $node->save(); // Saved as root

        // Category::create('root');
        // $node = Category::create([
        //     'title' => 'Foo',
        //     'children' => [
        //         [
        //             'name' => 'Bar',

        //             'children' => [
        //                 [ 'name' => 'Baz' ],
        //             ],
        //         ],
        //     ],
        // ]);

        // Category::create($attributes); // Saved as root
        // Category::create($attributes, $parent);

        // $node = new Category($attributes);
        // $node->save(); // Saved as root

        // $node->appendToNode($parent)->save();
        // $parent->appendNode($node);

        // # Explicit save
        // $node->afterNode($neighbor)->save();
        // $node->beforeNode($neighbor)->save();

        // Category::rebuildTree($data);
        // Category::rebuildSubtree($root, $data);

        // $bool = $node->down();
        // $bool = $node->up();

        // // Shift node by 3 siblings
        // $bool = $node->down(3);

        // $nodes = Category::get()->toTree();

        // $traverse = function ($categories, $prefix = '-') use (&$traverse) {
        //     foreach ($categories as $category) {
        //         echo PHP_EOL.$prefix.' '.$category->name;

        //         $traverse($category->children, $prefix.'-');
        //     }
        // };

        // $traverse($nodes);

     //    $categories = [
     //    	[
     //    		'id' => 1,
	    //     	'name' => 'category 1',
	    //     	'parent_id' => '0',
     //    	],
     //    	[
     //    		'id' => 2,
	    //     	'name' => 'category 2',
	    //     	'parent_id' => '0',
     //    	],
     //    	[
     //    		'id' => 3,
	    //     	'name' => 'sub category 1-1',
	    //     	'parent_id' => '1',
     //    	],
     //    ];

    	// foreach($categories as $category)
    	// {
     //    	Category::updateOrCreate(['id' => $category['id']], $category);
    	// }
    // }
}
