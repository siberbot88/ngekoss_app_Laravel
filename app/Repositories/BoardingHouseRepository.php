<?php

namespace App\Repositories;
use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use Filament\Forms\Components\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{
    public function getAllBoardingHouses($search = null, $city = null, $category = null)
    {
        $query = BoardingHouse::query();
        // jika disini diisi maka pencarian akan dijalankan
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }
        // jika city diisi maka dia akan mencari berdasarkan slug city
        if ($city) {
            $query->whereHas('city', function (Builder $query) use ($city) {
                $query->where('slug', $city);
            });
        }
        // jika kategori diisi maka dia akan mencari slug yang berdasarkan dengan kategorinya
        if ($category) {
            $query->whereHas('category', function (Builder $query) use ($category) {
                $query->where('slug', $category);
            });
        }
        return $query->get();
    }

    // berfungsi untuk mengambil kos populer dengan limit 5
    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->limit($limit)
            ->get();
    }

    // untuk menampilkan halaman kota, jika kota itu di klik maka akan muncul daftar kos yang ada di kota tersebut
    public function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get();
    }

    // untuk menampilkan halaman kategori, jika kategori itu di pilih maka akan muncul daftar kos yang ada pada kategori tersebut
    public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('category', function (Builder $query) use ($slug){
            $query->where('slug', $slug);
        })->get();
    }

    // jika kita pilih detail dan jika kita klik maka akan muncul detail kos berdasarkan slugnya
    public function getBoardingHouseBySlug($slug){
        return BoardingHouse::where('slug', $slug)->first();
    }
}
