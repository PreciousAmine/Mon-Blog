<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use Artesaos\SEOTools\Facades\SEOTools;
use Jorenvh\Share\Share;

class HomeController extends Controller
{
	public function index()
	{
		$posts = Posts::where('active', 1)
			->withCount(['comments as activeCommentsCount' => function ($query) {
				$query->where('active', 1);
			}])
			->with(['category', 'comments', 'user'])
			->orderBy('activeCommentsCount', 'desc')
			->latest()
			->paginate(4);

		$twitterCardImage = asset('images/blog-header.jpg');

		SEOTools::twitter()->setImage($twitterCardImage);

		$sidebarData = getSidebarData();

		return view('home', compact('posts'), $sidebarData);
	}
	public function sharePosts()
    {
        $shareButtons = \Share::page(
            'https://www.wattpad.com/story/281065374-my-heart',
            'Let the world know what you have written, and what you are reading!!',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        $posts = Posts::get();

        return view("share-post", compact('shareButtons', 'posts'));
    }


}
