<?php

namespace App\Services;

use SplQueue;
use Illuminate\Support\Facades\Cache;

/**
 * Class AlgoritmaService
 * 
 * Mengandung demonstrasi konsep-konsep Algoritma Pemrograman
 * (Sesuai dengan standar elemen kompetensi J.620100.022.02).
 */
class AlgoritmaService
{
    /**
     * Demonstrasi Elemen 2: Menggunakan Algoritma Pengurutan (Sorting)
     * 
     * Membandingkan Bubble Sort (manual) dan Usort bawaan PHP.
     * 
     * @return array
     */
    public function demoSorting(): array
    {
        // Hardcoded Data Pegawai
        $data = [
            ['nama' => 'Zack', 'golongan' => 'III/a'],
            ['nama' => 'Budi', 'golongan' => 'III/b'],
            ['nama' => 'Andi', 'golongan' => 'III/b'],
            ['nama' => 'Cici', 'golongan' => 'IV/a'],
        ];

        // 1. Bubble Sort (Hanya mengurutkan golongan ASC)
        // PSEUDOCODE: Loop array N kali, bandingkan elemen bersebelahan, tukar jika salah urutan.
        $bubbleData = $data;
        $n = count($bubbleData);
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($bubbleData[$j]['golongan'] > $bubbleData[$j + 1]['golongan']) {
                    $temp = $bubbleData[$j];
                    $bubbleData[$j] = $bubbleData[$j + 1];
                    $bubbleData[$j + 1] = $temp;
                }
            }
        }

        // 2. Usort (Multi-criteria: Golongan DESC, lalu Nama ASC)
        // MENGAPA: usort PHP mengimplementasikan variasi Quicksort/Mergesort yang sangat optimal,
        // lebih disarankan di dunia nyata daripada menulis sorting array secara manual.
        $usortData = $data;
        usort($usortData, function ($a, $b) {
            // Jika golongan sama, urutkan berdasarkan nama ASC
            if ($a['golongan'] === $b['golongan']) {
                return strcmp($a['nama'], $b['nama']);
            }
            // Jika golongan beda, urutkan berdasarkan golongan DESC
            return strcmp($b['golongan'], $a['golongan']);
        });

        return [
            'bubble_sort' => [
                'kompleksitas_waktu' => 'O(N^2)',
                'kompleksitas_ruang' => 'O(1)',
                'penjelasan' => 'Inefisien untuk dataset besar karena iterasi bersarang.',
                'hasil' => $bubbleData
            ],
            'usort_multi_criteria' => [
                'kompleksitas_waktu' => 'O(N log N) rata-rata',
                'kompleksitas_ruang' => 'O(log N)',
                'penjelasan' => 'Menggunakan fungsi bawaan C dari PHP, sangat cepat dan andal.',
                'hasil' => $usortData
            ]
        ];
    }

    /**
     * Demonstrasi Elemen 3: Menggunakan Algoritma Pencarian (Searching)
     * 
     * Membandingkan Linear Search, Binary Search, dan Hash Table.
     * 
     * @param string $targetNama
     * @return array
     */
    public function demoSearching(string $targetNama): array
    {
        // Data harus berurutan untuk Binary Search
        $data = [
            ['id' => 1, 'nama' => 'Andi'],
            ['id' => 2, 'nama' => 'Budi'],
            ['id' => 3, 'nama' => 'Cici'],
            ['id' => 4, 'nama' => 'Deni'],
        ];

        // 1. Linear Search
        $linearResult = null;
        foreach ($data as $item) {
            if ($item['nama'] === $targetNama) {
                $linearResult = $item;
                break;
            }
        }

        // 2. Binary Search
        // MENGAPA: Sangat efisien untuk data terurut, memotong rentang pencarian menjadi separuh di tiap langkah.
        $binaryResult = null;
        $low = 0;
        $high = count($data) - 1;
        while ($low <= $high) {
            $mid = (int) floor(($low + $high) / 2);
            $cmp = strcmp($data[$mid]['nama'], $targetNama);
            
            if ($cmp === 0) {
                $binaryResult = $data[$mid];
                break;
            } elseif ($cmp < 0) { // target > mid
                $low = $mid + 1;
            } else { // target < mid
                $high = $mid - 1;
            }
        }

        // 3. Hash Table (Menggunakan Array Asosiatif PHP)
        // MENGAPA: Jika sering mencari berdasarkan field spesifik (seperti 'nama'), merakit Hash Table 
        // memberikan kecepatan lookup instan secara matematis.
        $hashTable = [];
        foreach ($data as $item) {
            $hashTable[$item['nama']] = $item;
        }
        $hashResult = $hashTable[$targetNama] ?? null;

        return [
            'linear_search' => [
                'kompleksitas_waktu' => 'O(N)',
                'kompleksitas_ruang' => 'O(1)',
                'hasil' => $linearResult
            ],
            'binary_search' => [
                'kompleksitas_waktu' => 'O(log N)',
                'kompleksitas_ruang' => 'O(1)',
                'hasil' => $binaryResult
            ],
            'hash_table_lookup' => [
                'kompleksitas_waktu' => 'O(1) untuk lookup, O(N) untuk inisiasi awal',
                'kompleksitas_ruang' => 'O(N) untuk tabel hash ekstra',
                'hasil' => $hashResult
            ]
        ];
    }

    /**
     * Demonstrasi Elemen 4: Algoritma Lanjut (Rekursi & Dynamic Programming)
     * 
     * Menghitung nilai deret Fibonacci ke-N.
     * 
     * @param int $n
     * @return array
     */
    public function demoFibonacci(int $n): array
    {
        // Naive Recursion
        $naiveStart = microtime(true);
        $naiveResult = $this->fibonacciNaive($n);
        $naiveTimeMs = round((microtime(true) - $naiveStart) * 1000, 4);

        // Dynamic Programming (Memoization)
        $dpStart = microtime(true);
        $memo = [];
        $dpResult = $this->fibonacciDp($n, $memo);
        $dpTimeMs = round((microtime(true) - $dpStart) * 1000, 4);

        return [
            'rekursi_naif' => [
                'kompleksitas_waktu' => 'O(2^N)',
                'kompleksitas_ruang' => 'O(N) - Tumpukan panggilan/Call stack rekursi',
                'penjelasan' => 'Menghitung percabangan pohon yang sama berulang kali.',
                'hasil' => $naiveResult,
                'waktu_internal_ms' => $naiveTimeMs
            ],
            'rekursi_dengan_memoization_dp' => [
                'kompleksitas_waktu' => 'O(N)',
                'kompleksitas_ruang' => 'O(N) - Hashmap memo',
                'penjelasan' => 'Hasil perhitungan sebelumnya disimpan ke array, mencegah pengulangan komputasi.',
                'hasil' => $dpResult,
                'waktu_internal_ms' => $dpTimeMs
            ]
        ];
    }

    /**
     * Helper rekursi naif.
     */
    private function fibonacciNaive(int $n): int
    {
        if ($n <= 1) return $n;
        return $this->fibonacciNaive($n - 1) + $this->fibonacciNaive($n - 2);
    }

    /**
     * Helper rekursi dengan array penyimpan status (DP Memoization).
     */
    private function fibonacciDp(int $n, array &$memo): int
    {
        if ($n <= 1) return $n;
        if (isset($memo[$n])) return $memo[$n]; // Ambil dari cache internal
        
        $memo[$n] = $this->fibonacciDp($n - 1, $memo) + $this->fibonacciDp($n - 2, $memo);
        return $memo[$n];
    }

    /**
     * Demonstrasi Elemen 5: Struktur Data
     * 
     * Menerapkan Queue (Antrean) dan Generator (Lazy Evaluation).
     * 
     * @return array
     */
    public function demoDataStructure(): array
    {
        // 1. SplQueue (Standard PHP Library)
        // MENGAPA: Dibandingkan array_push() / array_shift() yang performanya menurun saat data besar (karena re-indexing),
        // SplQueue dibuat dari Doubly Linked List C, menjadikannya stabil.
        $queue = new SplQueue();
        $queue->enqueue('Proses Dokumen A');
        $queue->enqueue('Proses Dokumen B');
        $queueResult = [];
        while (!$queue->isEmpty()) {
            $queueResult[] = $queue->dequeue(); // FIFO
        }

        // 2. Generator dengan Keyword `yield`
        $generatorResult = [];
        $limit = 3;
        foreach ($this->largeDataGenerator() as $value) {
            $generatorResult[] = $value;
            if (count($generatorResult) >= $limit) break;
        }

        return [
            'spl_queue_fifo' => [
                'kompleksitas_waktu' => 'O(1) untuk operasi enqueue/dequeue',
                'kompleksitas_ruang' => 'O(N)',
                'hasil' => $queueResult
            ],
            'php_generator' => [
                'kompleksitas_waktu' => 'O(K) dimana K adalah data yang dikonsumsi (bukan total N)',
                'kompleksitas_ruang' => 'O(1)',
                'penjelasan' => 'Meskipun generator memproduksi ratusan ribu baris, memori PHP tidak akan penuh karena state ditahan per iterasi.',
                'hasil' => $generatorResult
            ]
        ];
    }

    /**
     * Membangkitkan dataset abstrak sangat besar.
     */
    private function largeDataGenerator()
    {
        for ($i = 1; $i <= 100000; $i++) {
            yield "Baris Ekspor Data Ke-" . $i;
        }
    }

    /**
     * Demonstrasi Elemen 6: Eksekusi Berbasis Konteks Web (Web Optimizations)
     * 
     * Cache layer untuk komputasi berat.
     * 
     * @return array
     */
    public function demoWebContext(): array
    {
        $hasil = Cache::remember('laporan_analitik_berat', 10, function () {
            // Simulasi query agregasi berat di database atau perhitungan loop berat
            usleep(300000); // Tertahan 300 milidetik
            return "Total Laporan Kinerja SDM Bulan Ini: 8,491 Dokumen";
        });

        return [
            'mekanisme' => 'Laravel Cache Remember',
            'kompleksitas_waktu' => 'Panggilan Pertama O(N lambat), Panggilan Berikutnya O(1) cepat',
            'kompleksitas_ruang' => 'O(M) di mana M adalah memori Redis/File Server',
            'hasil' => $hasil
        ];
    }
}
