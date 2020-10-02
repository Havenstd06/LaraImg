<?php

namespace App\Http\Livewire;

use App\Enums\ImageStateType;
use App\Image;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ImagesGrid extends Component
{
    use WithPagination;

    public $name;
    public $search = '';
    public $perPage = 20;
    public $field = 'id';
    public $asc = false;

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'field'  => ['except' => 'id'],
        'asc'    => ['except' => false],
        'page'   => ['except' => 1],
    ];

    public function mount()
    {
        $this->fill([
            'search'  => request()->query('search', $this->search),
            'perPage' => request()->query('perPage', $this->perPage),
            'field'   => request()->query('field', $this->field),
            'asc'     => request()->query('asc') ? false : true,
        ]);
        $this->sortBy($this->field);
    }

    public function resetTable()
    {
        $this->fill([
            'search'  => '',
            'perPage' => 20,
            'field'   => 'id',
            'asc'     => false,
        ]);
    }

    public function paginationView()
    {
        return 'vendor.pagination.default';
    }

    /**
     * Paginate collection.
     *
     * @param array|Collection $items
     * @param int $perPage
     * @param int $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    private function getAllImages(): Collection
    {
        $base = Image::search($this->search)
            ->get()
            ->where('is_public', ImageStateType::Discover);
        if (! empty(trim($this->search))) {
            $this->page = 1;
        }
        $sorted = $this->asc ? $base->sortBy($this->field) : $base->sortByDesc($this->field);
        if (! empty(trim($this->search))) {
            $this->page = 1;
        }

        return $sorted;
    }

    public function sortBy($field)
    {
        if ($this->field === $field) {
            $this->asc = ! $this->asc;
        } else {
            $this->asc = true;
        }

        $this->field = $field;
        $this->page = 1;
    }

    public function render()
    {
        $images = $this->paginate($this->getAllImages(), $this->perPage);

        return view('livewire.images-grid', ['images' => $images]);
    }
}
