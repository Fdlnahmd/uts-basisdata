Dokumentasi UTS Basis data

1. Pastikan Tools sudah terinstall dan sudah di nyalakan.
2. Buka Docker dan terminal Ubuntu
3. ketik cd boilerplate, lalu ketik ./start.sh uts-basisdata lalu ketik y dan enter tunggu sampai selesai.
4. Jika sudah selesai akan diminta buat repositori GitHub ketik y dan selesaikan step nya, Jika sudah maka akan membuka vscode uts-basisdata dan directory name nya menjadi uts-basisdata
5. lalu di terminal dalam vscode ketik dcm RumahSakit, Poliklinik, Pasien, Dokter, Obat, JadwalPraktek, Kunjungan dan Resep jika sudah berhasil akan muncul file di folder migrations dan seeder
6. lalu isi Migrations RumahSakit dengan isi berikut
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rumah_sakits', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rs', 20)->unique();
            $table->string('nama_rs');
            $table->text('alamat');
            $table->string('kota', 100);
            $table->string('provinsi', 100);
            $table->string('telepon', 20);
            $table->string('email')->nullable();
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');
            $table->enum('tipe_rs', ['A','B', 'C'])->default('C');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumah_sakits');
    }
};

7. buat factoryRumahSakit dengan isi berikut 
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RumahSakitFactory extends Factory
{
    public function definition() : array
    {
        $cities = ['Jakarta', 'Bandung', 'Surabaya'];
        $provinces = ['DKI Jakarta', 'Jawa Barat', 'Jawa Timur'];
        return [
            'kode_rs' => strtoupper($this->faker->bothify('RS###??')),
            'nama_rs' => $this->faker->company() . ' Hospital',
            'alamat' => $this->faker->address(),
            'kota' => $this->faker->randomElement($cities),
            'provinsi' => $this->faker->randomElement($provinces),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'tipe_rs' => $this->faker->randomElement(['A', 'B', 'C']),
        ];
    }
}

8. masukan data ke rumah sakit seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ini jika tidak punya data
        //RumahSakit::factory(3)->create();


        //ini jika punya data
        $data = [
            [
                'kode_rs' => 'RS001A',
                'nama_rs' => 'Rumah Sakit Sehat Sentosa',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'telepon' => '021-12345678',
                'email' => 'sehatsentosa@gmail.com',
                'status' => 'aktif',
                'tipe_rs' => 'A',
            ],
            [
                'kode_rs' => 'RS001B',
                'nama_rs' => 'Rumah Sakit Sentosa Sehat',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'kota' => 'Jakarta',
                'provinsi' => 'DKI Jakarta',
                'telepon' => '021-12345678',
                'email' => 'sentosasehat@gmail.com',
                'status' => 'aktif',
                'tipe_rs' => 'B',
            ]
        ];
        foreach ($data as $item) {
            RumahSakit::create($item);
        }
    }
}

9. masukkan data ke dalam models rumah sakit dengan isi berikut
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
}

10. isi migrations Poliklinik dengan isi berikut
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('polikliniks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rumah_sakit_id')->constrained('rumah_sakits')->cascadeOnDelete();
            $table->string('kode_poliklinik', 20)->unique();
            $table->string('nama_poliklinik');
            $table->string('lantai')->nullable();
            $table->string('gedung')->nullable();
            $table->enum('status', ['aktif','nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('polikliniks');
    }
};

11.masukkan data ke dalam models poliklinik dengan isi berikut
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poliklinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'rumah_sakit_id',
        'kode_poliklinik',
        'nama_poliklinik',
        'lantai',
        'gedung',
        'status',
    ];

    // Relasi: Poliklinik belong to Rumah Sakit
    public function rumahSakit(): BelongsTo
    {
        return $this->belongsTo(RumahSakit::class);
    }
}

12.update models rumah sakit dengan isi berikut
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RumahSakit extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_rs',
        'nama_rs',
        'alamat',
        'kota',
        'provinsi',
        'telepon',
        'email',
        'status',
        'tipe_rs',
    ];

    // Relasi: Rumah Sakit has many Poliklinik
    public function polikliniks(): HasMany
    {
        return $this->hasMany(Poliklinik::class);
    }
}

13. Isi seeder poliklinik dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\Poliklinik;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;

class PoliklinikSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID rumah sakit yang sudah ada
        $rs1 = RumahSakit::where('kode_rs', 'RS001A')->first();
        $rs2 = RumahSakit::where('kode_rs', 'RS001B')->first();

        $data = [
            // Poliklinik untuk RS Sehat Sentosa (RS001A)
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-001',
                'nama_poliklinik' => 'Poliklinik Umum',
                'lantai' => '1',
                'gedung' => 'Gedung A',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-002',
                'nama_poliklinik' => 'Poliklinik Gigi',
                'lantai' => '2',
                'gedung' => 'Gedung A',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-003',
                'nama_poliklinik' => 'Poliklinik Anak',
                'lantai' => '2',
                'gedung' => 'Gedung B',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs1->id,
                'kode_poliklinik' => 'POLI-004',
                'nama_poliklinik' => 'Poliklinik Kandungan',
                'lantai' => '3',
                'gedung' => 'Gedung B',
                'status' => 'aktif',
            ],
            
            // Poliklinik untuk RS Sentosa Sehat (RS001B)
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-005',
                'nama_poliklinik' => 'Poliklinik Umum',
                'lantai' => '1',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-006',
                'nama_poliklinik' => 'Poliklinik Jantung',
                'lantai' => '2',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-007',
                'nama_poliklinik' => 'Poliklinik Mata',
                'lantai' => '3',
                'gedung' => 'Gedung Utama',
                'status' => 'aktif',
            ],
            [
                'rumah_sakit_id' => $rs2->id,
                'kode_poliklinik' => 'POLI-008',
                'nama_poliklinik' => 'Poliklinik THT',
                'lantai' => '2',
                'gedung' => 'Gedung Annex',
                'status' => 'aktif',
            ],
        ];

        foreach ($data as $item) {
            Poliklinik::create($item);
        }
    }
}

14. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
        ]);
    }
}

15. lalu dci dan dcm Poliklinik Kembali

16. Masukan data ke dalam dokter 
migrations dengan isi berikut
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('spesialisasi');
            $table->string('no_sip')->unique(); // Surat Ijin Praktek
            $table->string('telepon');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};

17. masukkan data dokter models dengan isi berikut
<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_dokter',
        'nama',
        'jenis_kelamin',
        'spesialisasi',
        'no_sip',
        'telepon',
        'email',
        'alamat',
        'foto',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jadwalPrakteks()
    {
        return $this->hasMany(JadwalPraktek::class);
    }

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}
18.masukkan data ke dalam seeder dokter dengan isi berikut
<?php
namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = [
            [
                'kode_dokter' => 'DOK001',
                'nama' => 'Dr. Ahmad Fauzi, Sp.PD',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Penyakit Dalam',
                'no_sip' => 'SIP/001/2020',
                'telepon' => '081234567801',
                'email' => 'ahmad.fauzi@klinik.com',
                'alamat' => 'Jl. Kesehatan No. 10, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK002',
                'nama' => 'Dr. Siti Nurhaliza, Sp.A',
                'jenis_kelamin' => 'P',
                'spesialisasi' => 'Anak',
                'no_sip' => 'SIP/002/2020',
                'telepon' => '081234567802',
                'email' => 'siti.nurhaliza@klinik.com',
                'alamat' => 'Jl. Merdeka No. 15, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK003',
                'nama' => 'Dr. Budi Santoso, Sp.OG',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Kandungan',
                'no_sip' => 'SIP/003/2020',
                'telepon' => '081234567803',
                'email' => 'budi.santoso@klinik.com',
                'alamat' => 'Jl. Pahlawan No. 20, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK004',
                'nama' => 'Dr. Rina Wijaya, Sp.JP',
                'jenis_kelamin' => 'P',
                'spesialisasi' => 'Jantung',
                'no_sip' => 'SIP/004/2020',
                'telepon' => '081234567804',
                'email' => 'rina.wijaya@klinik.com',
                'alamat' => 'Jl. Sudirman No. 25, Jakarta',
            ],
            [
                'kode_dokter' => 'DOK005',
                'nama' => 'Dr. Hendra Gunawan, Sp.B',
                'jenis_kelamin' => 'L',
                'spesialisasi' => 'Bedah Umum',
                'no_sip' => 'SIP/005/2020',
                'telepon' => '081234567805',
                'email' => 'hendra.gunawan@klinik.com',
                'alamat' => 'Jl. Thamrin No. 30, Jakarta',
            ],
        ];

        foreach ($dokters as $dokter) {
            Dokter::create($dokter);
        }
    }
}
19. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
	    Dokterseeder::,
        ]);
    }
}

20. lalu dci dan dcm Dokter Kembali


21. Masukan data ke dalam pasien 
migrations dengan isi berikut
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique(); // Nomor Rekam Medis
            $table->string('nik')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('golongan_darah')->nullable();
            $table->string('telepon');
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('pekerjaan')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};

22. masukkan data pasien models dengan isi berikut
<?php
class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'nik',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'golongan_darah',
        'telepon',
        'email',
        'alamat',
        'pekerjaan',
        'nama_wali',
        'telepon_wali',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }

    public function getUmurAttribute()
    {
        return $this->tanggal_lahir->age;
    }
}

23.masukkan data ke dalam seeder pasien dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $pasiens = [
            [
                'no_rm' => 'RM001001',
                'nik' => '3175012345670001',
                'nama' => 'Andi Wijaya',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1990-05-15',
                'tempat_lahir' => 'Jakarta',
                'golongan_darah' => 'A',
                'telepon' => '081234567890',
                'email' => 'andi.wijaya@email.com',
                'alamat' => 'Jl. Mawar No. 10, Jakarta Selatan',
                'pekerjaan' => 'Karyawan Swasta',
            ],
            [
                'no_rm' => 'RM001002',
                'nik' => '3175012345670002',
                'nama' => 'Sari Indah',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1985-08-20',
                'tempat_lahir' => 'Bandung',
                'golongan_darah' => 'B',
                'telepon' => '081234567891',
                'email' => 'sari.indah@email.com',
                'alamat' => 'Jl. Melati No. 15, Jakarta Pusat',
                'pekerjaan' => 'Guru',
            ],
            [
                'no_rm' => 'RM001003',
                'nik' => '3175012345670003',
                'nama' => 'Budi Hartono',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2015-03-10',
                'tempat_lahir' => 'Jakarta',
                'golongan_darah' => 'O',
                'telepon' => '081234567892',
                'alamat' => 'Jl. Anggrek No. 20, Jakarta Barat',
                'pekerjaan' => 'Pelajar',
                'nama_wali' => 'Hartono',
                'telepon_wali' => '081234567893',
            ],
            [
                'no_rm' => 'RM001004',
                'nik' => '3175012345670004',
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '1978-12-05',
                'tempat_lahir' => 'Surabaya',
                'golongan_darah' => 'AB',
                'telepon' => '081234567894',
                'email' => 'dewi.lestari@email.com',
                'alamat' => 'Jl. Kenanga No. 25, Jakarta Timur',
                'pekerjaan' => 'Wiraswasta',
            ],
            [
                'no_rm' => 'RM001005',
                'nik' => '3175012345670005',
                'nama' => 'Rudi Setiawan',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1995-07-25',
                'tempat_lahir' => 'Semarang',
                'golongan_darah' => 'A',
                'telepon' => '081234567895',
                'email' => 'rudi.setiawan@email.com',
                'alamat' => 'Jl. Dahlia No. 30, Jakarta Utara',
                'pekerjaan' => 'Programmer',
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}

24. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
        ]);
    }
}


25. lalu dci dan dcm Pasien Kembali



26. Masukan data ke dalam obats 
migrations dengan isi berikut
<?php


27. masukkan data obat models dengan isi berikut<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obats', function (Blueprint $table) {
            $table->id();
            $table->string('kode_obat')->unique();
            $table->string('nama_obat');
            $table->string('kategori'); // Tablet, Sirup, Kapsul, dll
            $table->string('satuan'); // Box, Strip, Botol
            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(10);
            $table->decimal('harga_beli', 12, 2);
            $table->decimal('harga_jual', 12, 2);
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->string('produsen')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};

28.masukkan data ke dalam seeder obat dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $obats = [
            [
                'kode_obat' => 'OBT001',
                'nama_obat' => 'Paracetamol 500mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 200,
                'stok_minimum' => 50,
                'harga_beli' => 3000,
                'harga_jual' => 5000,
                'tanggal_kadaluarsa' => '2025-12-31',
                'produsen' => 'PT Farmasi Indonesia',
                'deskripsi' => 'Obat penurun panas dan pereda nyeri',
            ],
            [
                'kode_obat' => 'OBT002',
                'nama_obat' => 'Amoxicillin 500mg',
                'kategori' => 'Kapsul',
                'satuan' => 'Strip',
                'stok' => 150,
                'stok_minimum' => 30,
                'harga_beli' => 8000,
                'harga_jual' => 12000,
                'tanggal_kadaluarsa' => '2025-10-31',
                'produsen' => 'PT Medika Farma',
                'deskripsi' => 'Antibiotik untuk infeksi bakteri',
            ],
            [
                'kode_obat' => 'OBT003',
                'nama_obat' => 'OBH Combi',
                'kategori' => 'Sirup',
                'satuan' => 'Botol',
                'stok' => 80,
                'stok_minimum' => 20,
                'harga_beli' => 15000,
                'harga_jual' => 22000,
                'tanggal_kadaluarsa' => '2025-09-30',
                'produsen' => 'PT Anugrah Medika',
                'deskripsi' => 'Obat batuk dan flu',
            ],
            [
                'kode_obat' => 'OBT004',
                'nama_obat' => 'Antasida DOEN',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 120,
                'stok_minimum' => 40,
                'harga_beli' => 4000,
                'harga_jual' => 6500,
                'tanggal_kadaluarsa' => '2026-01-31',
                'produsen' => 'PT Kimia Farma',
                'deskripsi' => 'Obat maag dan gangguan lambung',
            ],
            [
                'kode_obat' => 'OBT005',
                'nama_obat' => 'Vitamin C 1000mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 180,
                'stok_minimum' => 50,
                'harga_beli' => 10000,
                'harga_jual' => 15000,
                'tanggal_kadaluarsa' => '2026-03-31',
                'produsen' => 'PT Supra Medika',
                'deskripsi' => 'Suplemen vitamin C',
            ],
            [
                'kode_obat' => 'OBT006',
                'nama_obat' => 'Ibuprofen 400mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 100,
                'stok_minimum' => 30,
                'harga_beli' => 5000,
                'harga_jual' => 8000,
                'tanggal_kadaluarsa' => '2025-11-30',
                'produsen' => 'PT Farmasi Indonesia',
                'deskripsi' => 'Anti inflamasi dan pereda nyeri',
            ],
            [
                'kode_obat' => 'OBT007',
                'nama_obat' => 'CTM 4mg',
                'kategori' => 'Tablet',
                'satuan' => 'Strip',
                'stok' => 150,
                'stok_minimum' => 40,
                'harga_beli' => 2000,
                'harga_jual' => 3500,
                'tanggal_kadaluarsa' => '2025-08-31',
                'produsen' => 'PT Medika Farma',
                'deskripsi' => 'Obat alergi',
            ],
            [
                'kode_obat' => 'OBT008',
                'nama_obat' => 'Salep Kulit',
                'kategori' => 'Salep',
                'satuan' => 'Tube',
                'stok' => 60,
                'stok_minimum' => 15,
                'harga_beli' => 12000,
                'harga_jual' => 18000,
                'tanggal_kadaluarsa' => '2025-07-31',
                'produsen' => 'PT Derma Care',
                'deskripsi' => 'Salep untuk infeksi kulit',
            ],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}




29. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
             ObatSeeder::class,
        ]);
    }
}


30. lalu dci dan dcm Obat Kembali



31. Masukan data ke dalam jadwal praktek 
migrations dengan isi berikut
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_prakteks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota_pasien')->default(20);
            $table->string('ruangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_prakteks');
    }
};

32. masukkan data jadwal praktek models dengan isi berikut
<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kuota_pasien',
        'ruangan',
        'is_active',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime:H:i',
        'jam_selesai' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}

33.masukkan data ke dalam seeder jadwaln praktek dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\JadwalPraktek;
use Illuminate\Database\Seeder;

class JadwalPraktekSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            // Dr. Ahmad Fauzi
            ['dokter_id' => 1, 'hari' => 'Senin', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            ['dokter_id' => 1, 'hari' => 'Rabu', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            ['dokter_id' => 1, 'hari' => 'Jumat', 'jam_mulai' => '08:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 20, 'ruangan' => 'Poli 1'],
            
            // Dr. Siti Nurhaliza
            ['dokter_id' => 2, 'hari' => 'Selasa', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25, 'ruangan' => 'Poli 2'],
            ['dokter_id' => 2, 'hari' => 'Kamis', 'jam_mulai' => '09:00', 'jam_selesai' => '13:00', 'kuota_pasien' => 25, 'ruangan' => 'Poli 2'],
            ['dokter_id' => 2, 'hari' => 'Sabtu', 'jam_mulai' => '09:00', 'jam_selesai' => '12:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 2'],
            
            // Dr. Budi Santoso
            ['dokter_id' => 3, 'hari' => 'Senin', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            ['dokter_id' => 3, 'hari' => 'Rabu', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            ['dokter_id' => 3, 'hari' => 'Jumat', 'jam_mulai' => '13:00', 'jam_selesai' => '17:00', 'kuota_pasien' => 15, 'ruangan' => 'Poli 3'],
            
            // Dr. Rina Wijaya
            ['dokter_id' => 4, 'hari' => 'Selasa', 'jam_mulai' => '14:00', 'jam_selesai' => '18:00', 'kuota_pasien' => 18, 'ruangan' => 'Poli 4'],
            ['dokter_id' => 4, 'hari' => 'Kamis', 'jam_mulai' => '14:00', 'jam_selesai' => '18:00', 'kuota_pasien' => 18, 'ruangan' => 'Poli 4'],
            
            // Dr. Hendra Gunawan
            ['dokter_id' => 5, 'hari' => 'Senin', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
            ['dokter_id' => 5, 'hari' => 'Rabu', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
            ['dokter_id' => 5, 'hari' => 'Jumat', 'jam_mulai' => '10:00', 'jam_selesai' => '14:00', 'kuota_pasien' => 12, 'ruangan' => 'Poli 5'],
        ];

        foreach ($jadwals as $jadwal) {
            JadwalPraktek::create($jadwal);
        }
    }
}



34. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
             ObatSeeder::class,
             JadwalPraktekSeeder::class,
        ]);
    }
}


35. lalu dci dan dcm JadwalPraktek Kembali



36. Masukan data ke dalam Kunjungan 
migrations dengan isi berikut
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('no_kunjungan')->unique();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan');
            $table->text('keluhan');
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('catatan')->nullable();
            $table->decimal('biaya_pemeriksaan', 12, 2)->default(0);
            $table->decimal('biaya_tindakan', 12, 2)->default(0);
            $table->decimal('total_biaya', 12, 2)->default(0);
            $table->enum('status', ['Menunggu', 'Diperiksa', 'Selesai', 'Batal'])->default('Menunggu');
            $table->timestamps();
        });
    } }

37. masukkan data Kunjungan models dengan isi berikut
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_kunjungan',
        'pasien_id',
        'dokter_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'keluhan',
        'diagnosa',
        'tindakan',
        'catatan',
        'biaya_pemeriksaan',
        'biaya_tindakan',
        'total_biaya',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'jam_kunjungan' => 'datetime:H:i',
        'biaya_pemeriksaan' => 'decimal:2',
        'biaya_tindakan' => 'decimal:2',
        'total_biaya' => 'decimal:2',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
};

38.masukkan data ke dalam seeder Kunjungan dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\Kunjungan;
use Illuminate\Database\Seeder;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $kunjungans = [
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '001',
                'pasien_id' => 1,
                'dokter_id' => 1,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '08:30:00',
                'keluhan' => 'Demam tinggi sejak 2 hari yang lalu, disertai sakit kepala',
                'diagnosa' => 'Demam Tifoid',
                'tindakan' => 'Pemberian obat antipiretik dan antibiotik',
                'catatan' => 'Pasien disarankan istirahat total dan konsumsi makanan bergizi',
                'biaya_pemeriksaan' => 150000,
                'biaya_tindakan' => 0,
                'total_biaya' => 150000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '002',
                'pasien_id' => 2,
                'dokter_id' => 2,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '09:15:00',
                'keluhan' => 'Batuk dan pilek, anak rewel',
                'diagnosa' => 'ISPA (Infeksi Saluran Pernapasan Atas)',
                'tindakan' => 'Pemberian obat batuk dan vitamin',
                'catatan' => 'Jaga suhu ruangan tetap hangat',
                'biaya_pemeriksaan' => 100000,
                'biaya_tindakan' => 0,
                'total_biaya' => 100000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '003',
                'pasien_id' => 3,
                'dokter_id' => 1,
                'tanggal_kunjungan' => now()->subDays(1)->format('Y-m-d'),
                'jam_kunjungan' => '10:00:00',
                'keluhan' => 'Nyeri perut dan mual',
                'diagnosa' => 'Gastritis',
                'tindakan' => 'Pemberian obat maag dan antasida',
                'catatan' => 'Hindari makanan pedas dan asam',
                'biaya_pemeriksaan' => 120000,
                'biaya_tindakan' => 50000,
                'total_biaya' => 170000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '004',
                'pasien_id' => 4,
                'dokter_id' => 3,
                'tanggal_kunjungan' => now()->subDays(2)->format('Y-m-d'),
                'jam_kunjungan' => '14:30:00',
                'keluhan' => 'Kontrol kehamilan rutin',
                'diagnosa' => 'Kehamilan normal 20 minggu',
                'tindakan' => 'USG dan pemeriksaan tekanan darah',
                'catatan' => 'Janin berkembang normal, konsumsi vitamin prenatal',
                'biaya_pemeriksaan' => 200000,
                'biaya_tindakan' => 150000,
                'total_biaya' => 350000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '005',
                'pasien_id' => 5,
                'dokter_id' => 4,
                'tanggal_kunjungan' => now()->format('Y-m-d'),
                'jam_kunjungan' => '15:00:00',
                'keluhan' => 'Nyeri dada dan sesak napas saat aktivitas',
                'diagnosa' => 'Hipertensi Grade 2',
                'tindakan' => 'EKG dan pemberian obat antihipertensi',
                'catatan' => 'Disarankan mengurangi konsumsi garam dan olahraga teratur',
                'biaya_pemeriksaan' => 180000,
                'biaya_tindakan' => 100000,
                'total_biaya' => 280000,
                'status' => 'Selesai',
            ],
            [
                'no_kunjungan' => 'KNJ' . date('Ymd') . '006',
                'pasien_id' => 1,
                'dokter_id' => 5,
                'tanggal_kunjungan' => now()->subDays(3)->format('Y-m-d'),
                'jam_kunjungan' => '11:00:00',
                'keluhan' => 'Luka sayat di tangan kanan',
                'diagnosa' => 'Vulnus Laceratum',
                'tindakan' => 'Jahit luka dan pemberian antibiotik',
                'catatan' => 'Kontrol kembali 7 hari untuk buka jahitan',
                'biaya_pemeriksaan' => 150000,
                'biaya_tindakan' => 200000,
                'total_biaya' => 350000,
                'status' => 'Selesai',
            ],
        ];

        foreach ($kunjungans as $kunjungan) {
            Kunjungan::create($kunjungan);
        }
    }
}

39. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
             ObatSeeder::class,
             JadwalPraktekSeeder::class,
             KunjunganSeeder::class,
        ]);
    }
}


40. lalu dci dan dcm Kunjungan Kembali



41. Masukan data ke dalam Resep 
migrations dengan isi berikut
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('no_resep')->unique();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade');
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('obat_id')->constrained('obats')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->text('aturan_pakai');
            $table->decimal('harga_satuan', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->date('tanggal_resep');
            $table->enum('status', ['Pending', 'Diproses', 'Selesai', 'Diambil'])->default('Pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};

42. masukkan data Resep models dengan isi berikut
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_resep',
        'kunjungan_id',
        'dokter_id',
        'pasien_id',
        'obat_id',
        'jumlah',
        'aturan_pakai',
        'harga_satuan',
        'subtotal',
        'tanggal_resep',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_resep' => 'date',
        'harga_satuan' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}

43.masukkan data ke dalam seeder Resep dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\Resep;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    public function run(): void
    {
        $reseps = [
            // Resep untuk Kunjungan 1 (Demam Tifoid) - 3 obat = 3 resep
            [
                'no_resep' => 'RSP' . date('Ymd') . '001',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 3,
                'aturan_pakai' => '3x sehari 1 tablet setelah makan',
                'harga_satuan' => 5000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Obat diminum sesuai aturan',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '002',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 2, // Amoxicillin
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 kapsul setelah makan, habiskan',
                'harga_satuan' => 12000,
                'subtotal' => 24000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '003',
                'kunjungan_id' => 1,
                'dokter_id' => 1,
                'pasien_id' => 1,
                'obat_id' => 5, // Vitamin C
                'jumlah' => 1,
                'aturan_pakai' => '1x sehari 1 tablet setelah makan',
                'harga_satuan' => 15000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 2 (ISPA)
            [
                'no_resep' => 'RSP' . date('Ymd') . '004',
                'kunjungan_id' => 2,
                'dokter_id' => 2,
                'pasien_id' => 2,
                'obat_id' => 3, // OBH Combi
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 sendok teh',
                'harga_satuan' => 22000,
                'subtotal' => 22000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Untuk anak, perhatikan dosis',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '005',
                'kunjungan_id' => 2,
                'dokter_id' => 2,
                'pasien_id' => 2,
                'obat_id' => 7, // CTM
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1/2 tablet',
                'harga_satuan' => 3500,
                'subtotal' => 3500,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 3 (Gastritis)
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-1 day')) . '006',
                'kunjungan_id' => 3,
                'dokter_id' => 1,
                'pasien_id' => 3,
                'obat_id' => 4, // Antasida
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 tablet sebelum makan',
                'harga_satuan' => 6500,
                'subtotal' => 13000,
                'tanggal_resep' => now()->subDays(1)->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Minum sebelum makan',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-1 day')) . '007',
                'kunjungan_id' => 3,
                'dokter_id' => 1,
                'pasien_id' => 3,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 tablet jika nyeri',
                'harga_satuan' => 5000,
                'subtotal' => 5000,
                'tanggal_resep' => now()->subDays(1)->format('Y-m-d'),
                'status' => 'Diambil',
            ],

            // Resep untuk Kunjungan 4 (Kehamilan) - tidak ada resep

            // Resep untuk Kunjungan 5 (Hipertensi)
            [
                'no_resep' => 'RSP' . date('Ymd') . '008',
                'kunjungan_id' => 5,
                'dokter_id' => 4,
                'pasien_id' => 5,
                'obat_id' => 6, // Ibuprofen
                'jumlah' => 2,
                'aturan_pakai' => '2x sehari 1 tablet setelah makan',
                'harga_satuan' => 8000,
                'subtotal' => 16000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Selesai',
                'catatan' => 'Kontrol tekanan darah setiap minggu',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd') . '009',
                'kunjungan_id' => 5,
                'dokter_id' => 4,
                'pasien_id' => 5,
                'obat_id' => 5, // Vitamin C
                'jumlah' => 1,
                'aturan_pakai' => '1x sehari 1 tablet',
                'harga_satuan' => 15000,
                'subtotal' => 15000,
                'tanggal_resep' => now()->format('Y-m-d'),
                'status' => 'Selesai',
            ],

            // Resep untuk Kunjungan 6 (Luka Jahit)
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '010',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 2, // Amoxicillin
                'jumlah' => 2,
                'aturan_pakai' => '3x sehari 1 kapsul, habiskan',
                'harga_satuan' => 12000,
                'subtotal' => 24000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
                'catatan' => 'Jaga luka tetap kering dan bersih',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '011',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 8, // Salep Kulit
                'jumlah' => 1,
                'aturan_pakai' => 'Oleskan 2x sehari pada luka',
                'harga_satuan' => 18000,
                'subtotal' => 18000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
            ],
            [
                'no_resep' => 'RSP' . date('Ymd', strtotime('-3 days')) . '012',
                'kunjungan_id' => 6,
                'dokter_id' => 5,
                'pasien_id' => 1,
                'obat_id' => 1, // Paracetamol
                'jumlah' => 1,
                'aturan_pakai' => '3x sehari 1 tablet jika nyeri',
                'harga_satuan' => 5000,
                'subtotal' => 5000,
                'tanggal_resep' => now()->subDays(3)->format('Y-m-d'),
                'status' => 'Diambil',
            ],
        ];

        foreach ($reseps as $resep) {
            Resep::create($resep);
        }
    }
}

44. update database seeder dengan isi berikut
<?php

namespace Database\Seeders;

use App\Models\RumahSakit;
use App\Models\Poliklinik;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            RumahSakitSeeder::class,
             PoliklinikSeeder::class,
             DokterSeeder::class,
             PasienSeeder::class,
             ObatSeeder::class,
             JadwalPraktekSeeder::class,
             KunjunganSeeder::class,
             ResepSeeder::class,
        ]);
    }
}


45. lalu dci dan dcm Resep Kembali

46. lakukan git push dengan cara 
1. git status (Melihat file mana yang berubah/baru/terhapus.)
2. git add -A (Menambahkan semua file)
3. git commit -m (Commit)
4. git push -u origin main(Jika push pertama kali) git push(untuk push berikutnya cukup ini saja)
5.


