<?php

namespace App\Livewire;
use App\Models\Post;
use App\Models\Category;
use Livewire\Component;

class BlogComponent extends Component
{
    public $search = '';
    public $category_id = null;
    public $categories;
    public $Posts;
    public function render()
    {
        $query = Post::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        $Posts = $query->get();
        // return view('Blog.index',compact('Posts'));
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->Posts = Post::paginate(10); 
    }

    public function updatedSearch()
    {
        $this->filterPosts();
    }

    public function updatedCategoryId()
    {
        $this->filterPosts();
    }

    public function filterPosts()
    {
        $query = Post::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        $this->Posts = $query->paginate(10);  // Adjust pagination as needed
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->category_id = null;
        $this->filterPosts();
    }

}
