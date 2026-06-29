<?php

namespace Database\Seeders;

use App\Models\Pemain;
use Illuminate\Database\Seeder;

class PemainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $targetDir = storage_path('app/public/pemain');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // List of source images and target filenames
        $images = [
            'messi' => database_path('seeders/images/messi.png'),
            'curry' => database_path('seeders/images/curry.png'),
            'hamilton' => database_path('seeders/images/hamilton.png'),
            'ronaldo' => database_path('seeders/images/ronaldo.png'),
            'lebron' => database_path('seeders/images/lebron.png'),
            'nadal' => database_path('seeders/images/nadal.png'),
            'kohli' => database_path('seeders/images/kohli.png'),
            'mahomes' => database_path('seeders/images/mahomes.png'),
            'ohtani' => database_path('seeders/images/ohtani.png'),
            'mbappe' => database_path('seeders/images/mbappe.png'),
        ];

        $paths = [];
        foreach ($images as $key => $source) {
            $paths[$key] = null;
            if (file_exists($source)) {
                $targetFile = $targetDir . '/' . $key . '.png';
                copy($source, $targetFile);
                $paths[$key] = 'pemain/' . $key . '.png';
            }
        }

        // 1. Lionel Messi
        Pemain::create([
            'nama_pemain' => 'Lionel Messi',
            'cabang_olahraga' => 'Sepak Bola',
            'klub' => 'Inter Miami CF',
            'usia' => 37,
            'gambar' => $paths['messi'],
        ]);

        // 2. Stephen Curry
        Pemain::create([
            'nama_pemain' => 'Stephen Curry',
            'cabang_olahraga' => 'Bola Basket',
            'klub' => 'Golden State Warriors',
            'usia' => 36,
            'gambar' => $paths['curry'],
        ]);

        // 3. Lewis Hamilton
        Pemain::create([
            'nama_pemain' => 'Lewis Hamilton',
            'cabang_olahraga' => 'Formula 1',
            'klub' => 'Ferrari',
            'usia' => 39,
            'gambar' => $paths['hamilton'],
        ]);

        // 4. Cristiano Ronaldo
        Pemain::create([
            'nama_pemain' => 'Cristiano Ronaldo',
            'cabang_olahraga' => 'Sepak Bola',
            'klub' => 'Al Nassr FC',
            'usia' => 39,
            'gambar' => $paths['ronaldo'],
        ]);

        // 5. LeBron James
        Pemain::create([
            'nama_pemain' => 'LeBron James',
            'cabang_olahraga' => 'Bola Basket',
            'klub' => 'Los Angeles Lakers',
            'usia' => 39,
            'gambar' => $paths['lebron'],
        ]);

        // 6. Rafael Nadal
        Pemain::create([
            'nama_pemain' => 'Rafael Nadal',
            'cabang_olahraga' => 'Tenis',
            'klub' => 'Real Madrid Tennis',
            'usia' => 38,
            'gambar' => $paths['nadal'],
        ]);

        // 7. Virat Kohli
        Pemain::create([
            'nama_pemain' => 'Virat Kohli',
            'cabang_olahraga' => 'Kriket',
            'klub' => 'Royal Challengers Bangalore',
            'usia' => 35,
            'gambar' => $paths['kohli'],
        ]);

        // 8. Patrick Mahomes
        Pemain::create([
            'nama_pemain' => 'Patrick Mahomes',
            'cabang_olahraga' => 'American Football',
            'klub' => 'Kansas City Chiefs',
            'usia' => 28,
            'gambar' => $paths['mahomes'],
        ]);

        // 9. Shohei Ohtani
        Pemain::create([
            'nama_pemain' => 'Shohei Ohtani',
            'cabang_olahraga' => 'Bisbol',
            'klub' => 'Los Angeles Dodgers',
            'usia' => 29,
            'gambar' => $paths['ohtani'],
        ]);

        // 10. Kylian Mbappé
        Pemain::create([
            'nama_pemain' => 'Kylian Mbappé',
            'cabang_olahraga' => 'Sepak Bola',
            'klub' => 'Real Madrid CF',
            'usia' => 25,
            'gambar' => $paths['mbappe'],
        ]);
    }
}
