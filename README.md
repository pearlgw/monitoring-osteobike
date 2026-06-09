# Dokumentasi Singkat Sistem Monitoring OSTEOBIKE

Sistem ini dibuat menggunakan Laravel untuk membantu admin memantau data pasien, data terapi, grafik perkembangan terapi, laporan PDF, dan pengingat jadwal terapi.

## Alur Umum Sistem

1. Admin login ke sistem.
2. Admin mengelola data pasien.
3. Admin membuat atau mengelola sesi terapi pasien.
4. Data hasil terapi berisi durasi, RPM, metode terapi, dan status terapi. Jika `activate_rom=true`, data ROM ikut aktif.
5. Dashboard menampilkan ringkasan data dan grafik 7 hari terakhir.
6. Halaman laporan menampilkan grafik berdasarkan kode pasien dan rentang tanggal.
7. Laporan dapat diunduh dalam bentuk PDF.
8. Sistem pengingat terapi dapat mengirim email kepada pasien sesuai jadwal.

## Migration

Migration digunakan untuk membuat struktur tabel database.

### `users`

Menyimpan data admin dan pasien.

Kolom utama:
- `kode_pasien`: kode unik pasien.
- `nama_lengkap`: nama user atau pasien.
- `email`: digunakan untuk login admin dan pengiriman email.
- `password`: password user.
- `role`: membedakan admin dan pasien.
- `umur`, `alamat`, `jenis_kelamin`: data identitas pasien.

### `detail_terapis`

Menyimpan data terapi pasien.

Kolom utama:
- `user_id`: relasi ke pasien.
- `tanggal_terapi`: tanggal pelaksanaan terapi.
- `berat_badan`: berat badan pasien.
- `diagnosa`: diagnosa pasien.
- `metode`: metode terapi, yaitu `Pasif` atau `Aktif`.
- `rpm`: kecepatan putaran terapi.
- `durasi`: lama terapi dalam menit.
- `rom`: range of motion, aktif jika `activate_rom=true`.
- `status`: status terapi, yaitu `belum` atau `sudah`.

### `pengingat_terapis`

Menyimpan jadwal pengingat terapi.

Kolom utama:
- `user_id`: relasi ke pasien.
- `tanggal_terapi_selanjutnya`: waktu pengingat terapi.
- `status`: status pengingat, yaitu `belum` atau `sudah`.

## Model

### `User`

Model untuk tabel `users`.

Fungsi utama:
- Menyimpan data admin dan pasien.
- Password otomatis di-hash.
- Memiliki relasi ke data terapi dan pengingat terapi.

### `DetailTerapi`

Model untuk tabel `detail_terapis`.

Fungsi utama:
- Menyimpan data hasil terapi pasien.
- Berelasi dengan `User`.
- Digunakan untuk dashboard, laporan, dan API hasil terapi.

### `PengingatTerapi`

Model untuk tabel `pengingat_terapis`.

Fungsi utama:
- Menyimpan jadwal pengingat terapi pasien.
- Berelasi dengan `User`.
- Digunakan untuk pengiriman email pengingat.

## Controller

### `DashboardController`

Mengatur halaman dashboard.

Fungsi utama:
- Menghitung total pasien.
- Menghitung total terapi.
- Menghitung rata-rata durasi dan RPM.
- Mengambil pasien terbaru.
- Membuat data grafik durasi dan RPM selama 7 hari terakhir.

### `PasienController`

Mengatur data pasien.

Fungsi utama:
- Menampilkan daftar pasien.
- Menambah pasien.
- Mengubah data pasien.
- Menghapus data pasien.

### `DetailTerapiController`

Mengatur data terapi.

Fungsi utama:
- Menampilkan daftar terapi.
- Menambah data terapi pasien.
- Mengubah data terapi.
- Menghapus data terapi.

### `LaporanController`

Mengatur laporan terapi.

Fungsi utama:
- Menampilkan halaman laporan admin dan guest.
- Filter laporan berdasarkan kode pasien dan rentang tanggal.
- Membuat data grafik durasi dan RPM.
- Membuat label tanggal dengan format hari dan tanggal.
- Mengunduh laporan dalam bentuk PDF.

### `PengingatTerapiController`

Mengatur jadwal pengingat terapi.

Fungsi utama:
- Menampilkan daftar pengingat.
- Menambah jadwal pengingat.
- Mengubah jadwal pengingat.
- Menghapus jadwal pengingat.

### `Api\TerapiController`

Mengatur pengiriman hasil terapi dari perangkat atau sistem luar.

Fungsi utama:
- Menerima data `rpm` dan `durasi`. Jika `activate_rom=true`, menerima `rom`.
- Mencari sesi terapi yang masih berstatus `belum`.
- Mengupdate hasil terapi.
- Mengubah status terapi menjadi `sudah`.

## Route

### Route Web

Route web berada di `routes/web.php`.

Alur utama:
- `/`: halaman landing page.
- `/dashboard`: halaman dashboard admin.
- `/pasien`: CRUD data pasien.
- `/terapi`: CRUD data terapi.
- `/pengingat-terapi`: CRUD pengingat terapi.
- `/laporan-admin`: laporan terapi untuk admin.
- `/laporan`: laporan terapi untuk guest.
- `/laporan-admin/download` dan `/laporan/download`: download laporan PDF.

Route dashboard, pasien, terapi, pengingat, dan laporan admin berada di dalam middleware `auth`, sehingga hanya bisa diakses setelah login.

### Route API

Route API berada di `routes/api.php`.

Endpoint utama:
- `POST /api/terapi/kirim-hasil`

Endpoint ini digunakan untuk mengirim hasil terapi berupa RPM dan durasi. Jika `activate_rom=true`, endpoint juga menerima ROM. Endpoint dilindungi middleware `api.key`.

## View

View berada di folder `resources/views`.

### Dashboard

File:
- `resources/views/pages/dashboard.blade.php`

Fungsi:
- Menampilkan ringkasan jumlah pasien dan terapi.
- Menampilkan rata-rata durasi dan RPM.
- Menampilkan grafik durasi dan RPM selama 7 hari terakhir.
- Menampilkan tombol `Emergency Stop`.

### Pasien

Folder:
- `resources/views/pages/pasien`

Fungsi:
- Menampilkan daftar pasien.
- Form tambah pasien.
- Form edit pasien.

### Terapi

Folder:
- `resources/views/pages/terapi`

Fungsi:
- Menampilkan daftar terapi.
- Form tambah terapi.
- Form edit terapi.

### Laporan

Folder:
- `resources/views/pages/laporan`

File utama:
- `index.blade.php`: laporan untuk admin.
- `laporan-guest.blade.php`: laporan untuk guest.
- `pdf.blade.php`: tampilan laporan saat diunduh sebagai PDF.

Fungsi:
- Filter laporan berdasarkan kode pasien dan tanggal.
- Menampilkan grafik durasi dan RPM.
- Menampilkan label sumbu X, Y, Tanggal, Menit, dan RPM.
- Mengirim gambar grafik ke controller untuk dimasukkan ke PDF.

### Pengingat Terapi

Folder:
- `resources/views/pages/pengingat-terapi`

Fungsi:
- Menampilkan daftar pengingat terapi.
- Form tambah pengingat.
- Form edit pengingat.

## Seeder

Seeder digunakan untuk mengisi data awal.

File utama:
- `database/seeders/UserSeeder.php`
- `database/seeders/DetailTerapiSeeder.php`

Fungsi:
- Membuat akun admin awal.
- Membuat contoh data pasien.
- Membuat contoh data terapi.

## Pengingat Email

Command:
- `app/Console/Commands/KirimPengingatTerapi.php`

Fungsi:
- Mengecek jadwal pengingat terapi yang statusnya `belum`.
- Mengirim email ke pasien jika jadwal sudah waktunya.
- Mengubah status pengingat menjadi `sudah` setelah email terkirim.

## Alur Data Terapi

1. Admin membuat data pasien.
2. Admin membuat data terapi untuk pasien.
3. Data terapi tersimpan di tabel `detail_terapis`.
4. Jika perangkat mengirim hasil terapi, API menerima data RPM dan durasi. Jika `activate_rom=true`, API juga menerima ROM.
5. Sistem mengupdate terapi yang masih berstatus `belum`.
6. Status terapi berubah menjadi `sudah`.
7. Data terapi ditampilkan di dashboard dan laporan.
8. Laporan dapat difilter dan diunduh sebagai PDF.

## Alur Laporan

1. User membuka halaman laporan.
2. User memasukkan kode pasien.
3. User memilih tanggal mulai dan tanggal akhir.
4. Sistem mengambil data terapi sesuai pasien dan rentang tanggal.
5. Data dikelompokkan berdasarkan tanggal terapi.
6. Sistem menghitung rata-rata durasi dan RPM per tanggal.
7. Grafik ditampilkan pada halaman laporan.
8. Jika download PDF, grafik dikonversi menjadi gambar dan dikirim ke controller.
9. Controller membuat file PDF dari `pdf.blade.php`.

## Cuplikan Kode Inti

Bagian ini berisi potongan kode utama yang mewakili alur migration, model, controller, route, dan view.

### Migration `users`

```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('kode_pasien')->nullable()->unique();
    $table->string('nama_lengkap');
    $table->string('email')->unique()->nullable();
    $table->string('password')->nullable();
    $table->string('role')->default('pasien');
    $table->integer('umur')->nullable();
    $table->text('alamat')->nullable();
    $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
    $table->rememberToken();
    $table->timestamps();
});
```

### Migration `detail_terapis`

```php
Schema::create('detail_terapis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->date('tanggal_terapi');
    $table->integer('berat_badan');
    $table->text('diagnosa');
    $table->enum('metode', ['Pasif', 'Aktif']);
    $table->integer('rpm')->nullable();
    $table->integer('durasi')->nullable();
    $table->integer('rom')->nullable();
    $table->enum('status', ['belum', 'sudah'])->default('belum');
    $table->timestamps();
});
```

### Migration `pengingat_terapis`

```php
Schema::create('pengingat_terapis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->dateTime('tanggal_terapi_selanjutnya');
    $table->enum('status', ['belum', 'sudah'])->default('belum');
    $table->timestamps();
});
```

### Model `User`

```php
#[Fillable([
    'nama_lengkap',
    'email',
    'password',
    'umur',
    'alamat',
    'role',
    'kode_pasien',
    'jenis_kelamin'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function detailTerapis()
    {
        return $this->hasMany(DetailTerapi::class);
    }

    public function pengingatTerapis()
    {
        return $this->hasMany(PengingatTerapi::class);
    }
}
```

### Model `DetailTerapi`

```php
class DetailTerapi extends Model
{
    protected $table = 'detail_terapis';
    protected $with = ['user'];

    protected $fillable = [
        'user_id',
        'tanggal_terapi',
        'berat_badan',
        'diagnosa',
        'metode',
        'rpm',
        'durasi',
        'rom',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

### Model `PengingatTerapi`

```php
class PengingatTerapi extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_terapi_selanjutnya',
        'status',
    ];

    protected $casts = [
        'tanggal_terapi_selanjutnya' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### Route Web

```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pasien', PasienController::class);
    Route::resource('terapi', DetailTerapiController::class);
    Route::resource('pengingat-terapi', PengingatTerapiController::class);

    Route::get('/laporan-admin', [LaporanController::class, 'index'])->name('laporan-admin');
    Route::post('/laporan-admin/filter', [LaporanController::class, 'filter'])->name('laporan-admin.filter');
    Route::post('/laporan-admin/download', [LaporanController::class, 'download'])->name('laporan-admin.download');
});

Route::get('/laporan', [LaporanController::class, 'laporan_guest'])->name('laporan');
Route::post('/laporan/filter', [LaporanController::class, 'filter_guest'])->name('laporan.filter');
Route::post('/laporan/download', [LaporanController::class, 'download'])->name('laporan.download');
```

### Route API

```php
Route::middleware('api.key')->group(function () {
    Route::post('terapi/kirim-hasil', [TerapiController::class, 'updateHasil']);
});
```

### Controller Dashboard

```php
public function index()
{
    $totalPasien = User::where('role', 'pasien')->count();
    $totalTerapi = DetailTerapi::count();
    $avgDurasi = DetailTerapi::avg('durasi');
    $avgRpm = DetailTerapi::avg('rpm');

    $terapiPerHari = DetailTerapi::selectRaw('
            tanggal_terapi,
            AVG(durasi) as avg_durasi,
            AVG(rpm) as avg_rpm
        ')
        ->whereBetween('tanggal_terapi', [
            Carbon::today()->subDays(6)->toDateString(),
            Carbon::today()->toDateString(),
        ])
        ->groupBy('tanggal_terapi')
        ->orderBy('tanggal_terapi')
        ->get()
        ->keyBy('tanggal_terapi');

    return view('pages.dashboard', compact(
        'totalPasien',
        'totalTerapi',
        'avgDurasi',
        'avgRpm',
        'chartLabels',
        'chartDurasi',
        'chartRpm',
    ));
}
```

### Controller Laporan

```php
private function formatChartDateLabel($tanggal): string
{
    $hariIndo = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
    $date = \Carbon\Carbon::parse($tanggal);

    return $hariIndo[$date->dayOfWeek] . ' ' . $date->format('d/m');
}

public function filter(Request $request)
{
    $request->validate([
        'kode_pasien' => 'required|string',
        'tanggal_start' => 'required|date',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_start',
    ]);

    $pasien = User::where('kode_pasien', $request->kode_pasien)
        ->where('role', 'pasien')
        ->first();

    $terapiData = DetailTerapi::where('user_id', $pasien->id)
        ->whereBetween('tanggal_terapi', [
            $request->tanggal_start,
            $request->tanggal_akhir,
        ])
        ->orderBy('tanggal_terapi')
        ->get();

    $grouped = $terapiData->groupBy('tanggal_terapi');
    $chartLabels = [];
    $chartDurasi = [];
    $chartRpm = [];

    foreach ($grouped as $tanggal => $rows) {
        $chartLabels[] = $this->formatChartDateLabel($tanggal);
        $chartDurasi[] = round($rows->avg('durasi'), 0);
        $chartRpm[] = round($rows->avg('rpm'), 0);
    }

    return view('pages.laporan.index', compact(
        'pasien',
        'chartLabels',
        'chartDurasi',
        'chartRpm',
    ));
}
```

### Controller API Hasil Terapi

```php
public function updateHasil(Request $request)
{
    $request->validate([
        'rpm' => 'required|integer',
        // Aktif jika activate_rom=true:
        // 'rom' => 'required|integer',
        'durasi' => 'required|integer',
    ]);

    $terapi = DetailTerapi::where('status', 'belum')->first();

    if (!$terapi) {
        return response()->json([
            'success' => false,
            'message' => 'Tidak ada sesi terapi yang aktif.',
        ], 404);
    }

    $terapi->update([
        'rpm' => $request->rpm,
        // Aktif jika activate_rom=true:
        // 'rom' => $request->rom,
        'durasi' => $request->durasi,
        'status' => 'sudah',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Data terapi berhasil dikirim.',
    ]);
}
```

### View Form Filter Laporan

```blade
<form method="POST" action="{{ route('laporan-admin.filter') }}">
    @csrf

    <input type="text" name="kode_pasien"
        value="{{ old('kode_pasien', $kode_pasien ?? '') }}"
        placeholder="Contoh: PSN001">

    <input type="date" name="tanggal_start" id="tanggalStart"
        value="{{ old('tanggal_start', $tanggal_start ?? '') }}"
        max="{{ now()->toDateString() }}">

    <input type="date" name="tanggal_akhir" id="tanggalAkhir"
        value="{{ old('tanggal_akhir', $tanggal_akhir ?? now()->toDateString()) }}"
        min="{{ old('tanggal_start', $tanggal_start ?? '') }}"
        max="{{ now()->toDateString() }}">

    <button type="submit">Tampilkan Grafik</button>
</form>
```

### View Grafik Chart.js

```blade
<canvas id="durasiChart" role="img" aria-label="Grafik durasi terapi per tanggal"></canvas>
<canvas id="rpmChart" role="img" aria-label="Grafik RPM terapi per tanggal"></canvas>
```

```js
const labels = {!! json_encode($chartLabels) !!};
const durasi = {!! json_encode($chartDurasi) !!};
const rpm = {!! json_encode($chartRpm) !!};

new Chart(document.getElementById('durasiChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'Durasi (menit)',
            data: durasi,
            borderColor: '#0EA5A4',
            fill: true,
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById('rpmChart'), {
    type: 'line',
    data: {
        labels,
        datasets: [{
            label: 'RPM',
            data: rpm,
            borderColor: '#3B82F6',
            borderDash: [5, 4],
            fill: true,
            tension: 0.4
        }]
    }
});
```

### Download PDF

```blade
<form method="POST" action="{{ route('laporan-admin.download') }}" id="downloadForm">
    @csrf

    <input type="hidden" name="kode_pasien" value="{{ $kode_pasien }}">
    <input type="hidden" name="tanggal_start" value="{{ $tanggal_start }}">
    <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
    <input type="hidden" name="chart_durasi_img" id="chartDurasiImg">
    <input type="hidden" name="chart_rpm_img" id="chartRpmImg">

    <button type="button" onclick="downloadPDF()">Download PDF</button>
</form>
```

```js
function downloadPDF() {
    const durasiCanvas = document.getElementById('durasiChart');
    const rpmCanvas = document.getElementById('rpmChart');

    document.getElementById('chartDurasiImg').value = durasiCanvas.toDataURL('image/png');
    document.getElementById('chartRpmImg').value = rpmCanvas.toDataURL('image/png');

    document.getElementById('downloadForm').submit();
}
```

### Command Pengingat Email

```php
public function handle()
{
    $data = PengingatTerapi::with('user')
        ->where('status', 'belum')
        ->where('tanggal_terapi_selanjutnya', '<=', Carbon::now())
        ->get();

    foreach ($data as $item) {
        if (!$item->user || !$item->user->email) {
            continue;
        }

        Mail::to($item->user->email)
            ->send(new PengingatTerapiMail($item->user));

        $item->update([
            'status' => 'sudah'
        ]);
    }

    return Command::SUCCESS;
}
```

## Kesimpulan

Kode program ini memiliki alur utama dari database, model, controller, route, dan view. Migration membentuk tabel, model menghubungkan data, controller mengatur proses, route menentukan URL, dan view menampilkan halaman kepada pengguna.
