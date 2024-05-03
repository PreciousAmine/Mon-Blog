<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Posts;

class UpvoteDownvote extends Component
{
	public Posts $post;
	public function mount(Posts $post)
	{
		$this->post = $post;

	}
    public function render()
    {
			$upvotes = \App\Models\UpvoteDownvote:: where('post_id', '=', $this->post->id)
			->where('is_upvote', '=', true)
			->count();

			$upvotes = \App\Models\UpvoteDownvote:: where('post_id', '=', $this->post->id)
			->where('is_upvote', '=', false)
			->count();

        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes'));
    }

		public function upvoteDownvote($upvotes = true){
			/** @var \App\Models\User $user */
			$user = request()->user();
			if (!$user){
				return $this->redirect('login');
			}

			if (!user->Auth::user()->id){
				return $this->redirect(route);
			}
		}
}
