<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;

class DistrictsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $this->disableForeignKeys("districts");
        $this->delete('districts');
        
        \DB::table('districts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'region_id' => 1,
                'name' => 'Meru',
                'isactive' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'region_id' => 1,
                'name' => 'Arusha City',
                'isactive' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'region_id' => 1,
                'name' => 'Arusha District',
                'isactive' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'region_id' => 1,
                'name' => 'Karatu',
                'isactive' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'region_id' => 1,
                'name' => 'Longido',
                'isactive' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'region_id' => 1,
                'name' => 'Monduli',
                'isactive' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'region_id' => 1,
                'name' => 'Ngorongoro',
                'isactive' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'region_id' => 2,
                'name' => 'Ilala',
                'isactive' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'region_id' => 2,
                'name' => 'Kinondoni',
                'isactive' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'region_id' => 2,
                'name' => 'Temeke',
                'isactive' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'region_id' => 2,
                'name' => 'Kigamboni',
                'isactive' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'region_id' => 2,
                'name' => 'Ubungo',
                'isactive' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'region_id' => 3,
                'name' => 'Bahi',
                'isactive' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'region_id' => 3,
                'name' => 'Chamwino',
                'isactive' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'region_id' => 3,
                'name' => 'Chemba',
                'isactive' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'region_id' => 3,
                'name' => 'Dodoma Municipal',
                'isactive' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'region_id' => 3,
                'name' => 'Kondoa',
                'isactive' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'region_id' => 3,
                'name' => 'Kongwa',
                'isactive' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'region_id' => 3,
                'name' => 'Mpwapwa',
                'isactive' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'region_id' => 4,
                'name' => 'Bukombe',
                'isactive' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'region_id' => 4,
                'name' => 'Chato',
                'isactive' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'region_id' => 4,
                'name' => 'Geita Town Council & Geita District Council',
                'isactive' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'region_id' => 4,
                'name' => 'Mbogwe',
                'isactive' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'region_id' => 4,
                'name' => 'Nyang\'hwale',
                'isactive' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'region_id' => 5,
                'name' => 'Iringa District',
                'isactive' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'region_id' => 5,
                'name' => 'Iringa Municipal',
                'isactive' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'region_id' => 5,
                'name' => 'Kilolo',
                'isactive' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'region_id' => 5,
                'name' => 'Mafinga Town',
                'isactive' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'region_id' => 5,
                'name' => 'Mufindi',
                'isactive' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'region_id' => 6,
                'name' => 'Biharamulo',
                'isactive' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'region_id' => 6,
                'name' => 'Bukoba',
                'isactive' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'region_id' => 6,
                'name' => 'Bukoba Municipal',
                'isactive' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'region_id' => 6,
                'name' => 'Karagwe',
                'isactive' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'region_id' => 6,
                'name' => 'Kyerwa',
                'isactive' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'region_id' => 6,
                'name' => 'Missenyi',
                'isactive' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'region_id' => 6,
                'name' => 'Muleba',
                'isactive' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'region_id' => 6,
                'name' => 'Ngara',
                'isactive' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'region_id' => 7,
                'name' => 'Mlele',
                'isactive' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'region_id' => 7,
                'name' => 'Mpanda',
                'isactive' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'region_id' => 7,
                'name' => 'Mpanda Town',
                'isactive' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'region_id' => 8,
                'name' => 'Buhigwe',
                'isactive' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'region_id' => 8,
                'name' => 'Kakonko',
                'isactive' => 1,
            ),
            42 => 
            array (
                'id' => 43,
                'region_id' => 8,
                'name' => 'Kasulu District',
                'isactive' => 1,
            ),
            43 => 
            array (
                'id' => 44,
                'region_id' => 8,
                'name' => 'Kasulu Town',
                'isactive' => 1,
            ),
            44 => 
            array (
                'id' => 45,
                'region_id' => 8,
                'name' => 'Kibondo',
                'isactive' => 1,
            ),
            45 => 
            array (
                'id' => 46,
                'region_id' => 8,
                'name' => 'Kigoma District',
                'isactive' => 1,
            ),
            46 => 
            array (
                'id' => 47,
                'region_id' => 8,
                'name' => 'Kigoma-Ujiji Municipal',
                'isactive' => 1,
            ),
            47 => 
            array (
                'id' => 48,
                'region_id' => 8,
                'name' => 'Uvinza',
                'isactive' => 1,
            ),
            48 => 
            array (
                'id' => 49,
                'region_id' => 9,
                'name' => 'Hai',
                'isactive' => 1,
            ),
            49 => 
            array (
                'id' => 50,
                'region_id' => 9,
                'name' => 'Moshi District',
                'isactive' => 1,
            ),
            50 => 
            array (
                'id' => 51,
                'region_id' => 9,
                'name' => 'Moshi Municipal',
                'isactive' => 1,
            ),
            51 => 
            array (
                'id' => 52,
                'region_id' => 9,
                'name' => 'Mwanga',
                'isactive' => 1,
            ),
            52 => 
            array (
                'id' => 53,
                'region_id' => 9,
                'name' => 'Rombo',
                'isactive' => 1,

            ),
            53 => 
            array (
                'id' => 54,
                'region_id' => 9,
                'name' => 'Same',
                'isactive' => 1,
            ),
            54 => 
            array (
                'id' => 55,
                'region_id' => 9,
                'name' => 'Siha',
                'isactive' => 1,
            ),
            55 => 
            array (
                'id' => 56,
                'region_id' => 10,
                'name' => 'Kilwa',
                'isactive' => 1,
            ),
            56 => 
            array (
                'id' => 57,
                'region_id' => 10,
                'name' => 'Lindi District',
                'isactive' => 1,
            ),
            57 => 
            array (
                'id' => 58,
                'region_id' => 10,
                'name' => 'Lindi Municipal',
                'isactive' => 1,
            ),
            58 => 
            array (
                'id' => 59,
                'region_id' => 10,
                'name' => 'Liwale',
                'isactive' => 1,
            ),
            59 => 
            array (
                'id' => 60,
                'region_id' => 10,
                'name' => 'Nachingwea',
                'isactive' => 1,
            ),
            60 => 
            array (
                'id' => 61,
                'region_id' => 10,
                'name' => 'Ruangwa',
                'isactive' => 1,
            ),
            61 => 
            array (
                'id' => 62,
                'region_id' => 11,
                'name' => 'Babati Town',
                'isactive' => 1,
            ),
            62 => 
            array (
                'id' => 63,
                'region_id' => 11,
                'name' => 'Babati District',
                'isactive' => 1,
            ),
            63 => 
            array (
                'id' => 64,
                'region_id' => 11,
                'name' => 'Hanang',
                'isactive' => 1,
            ),
            64 => 
            array (
                'id' => 65,
                'region_id' => 11,
                'name' => 'Kiteto',
                'isactive' => 1,
            ),
            65 => 
            array (
                'id' => 66,
                'region_id' => 11,
                'name' => 'Mbulu',
                'isactive' => 1,
            ),
            66 => 
            array (
                'id' => 67,
                'region_id' => 11,
                'name' => 'Simanjiro',
                'isactive' => 1,
            ),
            67 => 
            array (
                'id' => 68,
                'region_id' => 12,
                'name' => 'Bunda',
                'isactive' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'region_id' => 12,
                'name' => 'Butiama',
                'isactive' => 1,
            ),
            69 => 
            array (
                'id' => 70,
                'region_id' => 12,
                'name' => 'Musoma District',
                'isactive' => 1,
            ),
            70 => 
            array (
                'id' => 71,
                'region_id' => 12,
                'name' => 'Musoma Municipal',
                'isactive' => 1,
            ),
            71 => 
            array (
                'id' => 72,
                'region_id' => 12,
                'name' => 'Rorya',
                'isactive' => 1,
            ),
            72 => 
            array (
                'id' => 73,
                'region_id' => 12,
                'name' => 'Serengeti',
                'isactive' => 1,
            ),
            73 => 
            array (
                'id' => 74,
                'region_id' => 12,
                'name' => 'Tarime',
                'isactive' => 1,
            ),
            74 => 
            array (
                'id' => 75,
                'region_id' => 13,
                'name' => 'Busokelo',
                'isactive' => 1,
            ),
            75 => 
            array (
                'id' => 76,
                'region_id' => 13,
                'name' => 'Chunya',
                'isactive' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'region_id' => 13,
                'name' => 'Kyela',
                'isactive' => 1,
            ),
            77 => 
            array (
                'id' => 78,
                'region_id' => 13,
                'name' => 'Mbarali',
                'isactive' => 1,
            ),
            78 => 
            array (
                'id' => 79,
                'region_id' => 13,
                'name' => 'Mbeya City',
                'isactive' => 1,
            ),
            79 => 
            array (
                'id' => 80,
                'region_id' => 13,
                'name' => 'Mbeya District',
                'isactive' => 1,
            ),
            80 => 
            array (
                'id' => 81,
                'region_id' => 13,
                'name' => 'Rungwe',
                'isactive' => 1,
            ),
            81 => 
            array (
                'id' => 82,
                'region_id' => 14,
                'name' => 'Gairo',
                'isactive' => 1,
            ),
            82 => 
            array (
                'id' => 83,
                'region_id' => 14,
                'name' => 'Kilombero',
                'isactive' => 1,
            ),
            83 => 
            array (
                'id' => 84,
                'region_id' => 14,
                'name' => 'Kilosa',
                'isactive' => 1,
            ),
            84 => 
            array (
                'id' => 85,
                'region_id' => 14,
                'name' => 'Morogoro District',
                'isactive' => 1,
            ),
            85 => 
            array (
                'id' => 86,
                'region_id' => 14,
                'name' => 'Morogoro Municipal',
                'isactive' => 1,
            ),
            86 => 
            array (
                'id' => 87,
                'region_id' => 14,
                'name' => 'Mvomero',
                'isactive' => 1,
            ),
            87 => 
            array (
                'id' => 88,
                'region_id' => 14,
                'name' => 'Ulanga',
                'isactive' => 1,
            ),
            88 => 
            array (
                'id' => 89,
                'region_id' => 15,
                'name' => 'Masasi District',
                'isactive' => 1,
            ),
            89 => 
            array (
                'id' => 90,
                'region_id' => 15,
                'name' => 'Masasi Town',
                'isactive' => 1,
            ),
            90 => 
            array (
                'id' => 91,
                'region_id' => 15,
                'name' => 'Mtwara District',
                'isactive' => 1,
            ),
            91 => 
            array (
                'id' => 92,
                'region_id' => 15,
                'name' => 'Mtwara Municipal',
                'isactive' => 1,
            ),
            92 => 
            array (
                'id' => 93,
                'region_id' => 15,
                'name' => 'Nanyumbu',
                'isactive' => 1,
            ),
            93 => 
            array (
                'id' => 94,
                'region_id' => 15,
                'name' => 'Newala',
                'isactive' => 1,
            ),
            94 => 
            array (
                'id' => 95,
                'region_id' => 15,
                'name' => 'Tandahimba',
                'isactive' => 1,
            ),
            95 => 
            array (
                'id' => 96,
                'region_id' => 16,
                'name' => 'Ilemela',
                'isactive' => 1,
            ),
            96 => 
            array (
                'id' => 97,
                'region_id' => 16,
                'name' => 'Kwimba',
                'isactive' => 1,
            ),
            97 => 
            array (
                'id' => 98,
                'region_id' => 16,
                'name' => 'Magu',
                'isactive' => 1,
            ),
            98 => 
            array (
                'id' => 99,
                'region_id' => 16,
                'name' => 'Misungwi',
                'isactive' => 1,
            ),
            99 => 
            array (
                'id' => 100,
                'region_id' => 16,
                'name' => 'Nyamagana',
                'isactive' => 1,
            ),
            100 => 
            array (
                'id' => 101,
                'region_id' => 16,
                'name' => 'Sengerema',
                'isactive' => 1,
            ),
            101 => 
            array (
                'id' => 102,
                'region_id' => 16,
                'name' => 'Ukerewe',
                'isactive' => 1,
            ),
            102 => 
            array (
                'id' => 103,
                'region_id' => 32,
                'name' => 'Kati',
                'isactive' => 1,
            ),
            103 => 
            array (
                'id' => 104,
                'region_id' => 32,
                'name' => 'Kusini',
                'isactive' => 1,
            ),
            104 => 
            array (
                'id' => 105,
                'region_id' => 30,
                'name' => 'Magharibi',
                'isactive' => 1,
            ),
            105 => 
            array (
                'id' => 106,
                'region_id' => 30,
                'name' => 'Mjini',
                'isactive' => 1,
            ),
            106 => 
            array (
                'id' => 107,
                'region_id' => 33,
                'name' => 'Kaskazini A',
                'isactive' => 1,
            ),
            107 => 
            array (
                'id' => 108,
                'region_id' => 33,
                'name' => 'Kaskazini B',
                'isactive' => 1,
            ),
            108 => 
            array (
                'id' => 109,
                'region_id' => 18,
                'name' => 'Micheweni',
                'isactive' => 1,
            ),
            109 => 
            array (
                'id' => 110,
                'region_id' => 18,
                'name' => 'Wete',
                'isactive' => 1,
            ),
            110 => 
            array (
                'id' => 111,
                'region_id' => 19,
                'name' => 'Chake Chake',
                'isactive' => 1,
            ),
            111 => 
            array (
                'id' => 112,
                'region_id' => 19,
                'name' => 'Mkoani',
                'isactive' => 1,
            ),
            112 => 
            array (
                'id' => 113,
                'region_id' => 17,
                'name' => 'Ludewa',
                'isactive' => 1,
            ),
            113 => 
            array (
                'id' => 114,
                'region_id' => 17,
                'name' => 'Makambako',
                'isactive' => 1,
            ),
            114 => 
            array (
                'id' => 115,
                'region_id' => 17,
                'name' => 'Makete',
                'isactive' => 1,
            ),
            115 => 
            array (
                'id' => 116,
                'region_id' => 17,
                'name' => 'Njombe District',
                'isactive' => 1,
            ),
            116 => 
            array (
                'id' => 117,
                'region_id' => 17,
                'name' => 'Njombe Town',
                'isactive' => 1,
            ),
            117 => 
            array (
                'id' => 118,
                'region_id' => 17,
                'name' => 'Wanging\'ombe',
                'isactive' => 1,
            ),
            118 => 
            array (
                'id' => 119,
                'region_id' => 20,
                'name' => 'Bagamoyo',
                'isactive' => 1,
            ),
            119 => 
            array (
                'id' => 120,
                'region_id' => 20,
                'name' => 'Kibaha District',
                'isactive' => 1,
            ),
            120 => 
            array (
                'id' => 121,
                'region_id' => 20,
                'name' => 'Kibaha Town',
                'isactive' => 1,
            ),
            121 => 
            array (
                'id' => 122,
                'region_id' => 20,
                'name' => 'Kisarawe',
                'isactive' => 1,
            ),
            122 => 
            array (
                'id' => 123,
                'region_id' => 20,
                'name' => 'Mafia',
                'isactive' => 1,
            ),
            123 => 
            array (
                'id' => 124,
                'region_id' => 20,
                'name' => 'Mkuranga',
                'isactive' => 1,
            ),
            124 => 
            array (
                'id' => 125,
                'region_id' => 20,
                'name' => 'Rufiji',
                'isactive' => 1,
            ),
            125 => 
            array (
                'id' => 126,
                'region_id' => 21,
                'name' => 'Kalambo',
                'isactive' => 1,
            ),
            126 => 
            array (
                'id' => 127,
                'region_id' => 21,
                'name' => 'Nkasi',
                'isactive' => 1,
            ),
            127 => 
            array (
                'id' => 128,
                'region_id' => 21,
                'name' => 'Sumbawanga District',
                'isactive' => 1,
            ),
            128 => 
            array (
                'id' => 129,
                'region_id' => 21,
                'name' => 'Sumbawanga Municipal',
                'isactive' => 1,
            ),
            129 => 
            array (
                'id' => 130,
                'region_id' => 22,
                'name' => 'Mbinga',
                'isactive' => 1,
            ),
            130 => 
            array (
                'id' => 131,
                'region_id' => 22,
                'name' => 'Songea District',
                'isactive' => 1,
            ),
            131 => 
            array (
                'id' => 132,
                'region_id' => 22,
                'name' => 'Songea Municipal',
                'isactive' => 1,
            ),
            132 => 
            array (
                'id' => 133,
                'region_id' => 22,
                'name' => 'Tunduru',
                'isactive' => 1,
            ),
            133 => 
            array (
                'id' => 134,
                'region_id' => 22,
                'name' => 'Namtumbo',
                'isactive' => 1,
            ),
            134 => 
            array (
                'id' => 135,
                'region_id' => 22,
                'name' => 'Nyasa',
                'isactive' => 1,
            ),
            135 => 
            array (
                'id' => 136,
                'region_id' => 24,
                'name' => 'Bariadi',
                'isactive' => 1,
            ),
            136 => 
            array (
                'id' => 137,
                'region_id' => 24,
                'name' => 'Busega',
                'isactive' => 1,
            ),
            137 => 
            array (
                'id' => 138,
                'region_id' => 24,
                'name' => 'Itilima',
                'isactive' => 1,
            ),
            138 => 
            array (
                'id' => 139,
                'region_id' => 24,
                'name' => 'Maswa',
                'isactive' => 1,
            ),
            139 => 
            array (
                'id' => 140,
                'region_id' => 24,
                'name' => 'Meatu',
                'isactive' => 1,
            ),
            140 => 
            array (
                'id' => 141,
                'region_id' => 25,
                'name' => 'Ikungi',
                'isactive' => 1,
            ),
            141 => 
            array (
                'id' => 142,
                'region_id' => 25,
                'name' => 'Iramba',
                'isactive' => 1,
            ),
            142 => 
            array (
                'id' => 143,
                'region_id' => 25,
                'name' => 'Manyoni',
                'isactive' => 1,
            ),
            143 => 
            array (
                'id' => 144,
                'region_id' => 25,
                'name' => 'Mkalama',
                'isactive' => 1,
            ),
            144 => 
            array (
                'id' => 145,
                'region_id' => 25,
                'name' => 'Singida District',
                'isactive' => 1,
            ),
            145 => 
            array (
                'id' => 146,
                'region_id' => 25,
                'name' => 'Singida Municipal',
                'isactive' => 1,
            ),
            146 => 
            array (
                'id' => 147,
                'region_id' => 26,
                'name' => 'Igunga',
                'isactive' => 1,
            ),
            147 => 
            array (
                'id' => 148,
                'region_id' => 26,
                'name' => 'Kaliua',
                'isactive' => 1,
            ),
            148 => 
            array (
                'id' => 149,
                'region_id' => 26,
                'name' => 'Nzega',
                'isactive' => 1,
            ),
            149 => 
            array (
                'id' => 150,
                'region_id' => 26,
                'name' => 'Sikonge',
                'isactive' => 1,
            ),
            150 => 
            array (
                'id' => 151,
                'region_id' => 26,
                'name' => 'Tabora Municipal',
                'isactive' => 1,
            ),
            151 => 
            array (
                'id' => 152,
                'region_id' => 26,
                'name' => 'Urambo',
                'isactive' => 1,
            ),
            152 => 
            array (
                'id' => 153,
                'region_id' => 26,
                'name' => 'Uyui',
                'isactive' => 1,
            ),
            153 => 
            array (
                'id' => 154,
                'region_id' => 27,
                'name' => 'Handeni District',
                'isactive' => 1,
            ),
            154 => 
            array (
                'id' => 155,
                'region_id' => 27,
                'name' => 'Handeni Town',
                'isactive' => 1,
            ),
            155 => 
            array (
                'id' => 156,
                'region_id' => 27,
                'name' => 'Kilindi',
                'isactive' => 1,
            ),
            156 => 
            array (
                'id' => 157,
                'region_id' => 27,
                'name' => 'Korogwe Town',
                'isactive' => 1,
            ),
            157 => 
            array (
                'id' => 158,
                'region_id' => 27,
                'name' => 'Korogwe District',
                'isactive' => 1,
            ),
            158 => 
            array (
                'id' => 159,
                'region_id' => 27,
                'name' => 'Lushoto',
                'isactive' => 1,
            ),
            159 => 
            array (
                'id' => 160,
                'region_id' => 27,
                'name' => 'Muheza',
                'isactive' => 1,
            ),
            160 => 
            array (
                'id' => 161,
                'region_id' => 27,
                'name' => 'Mkinga',
                'isactive' => 1,
            ),
            161 => 
            array (
                'id' => 162,
                'region_id' => 27,
                'name' => 'Pangani',
                'isactive' => 1,
            ),
            162 => 
            array (
                'id' => 163,
                'region_id' => 27,
                'name' => 'Tanga City',
                'isactive' => 1,
            ),
            163 => 
            array (
                'id' => 164,
                'region_id' => 23,
                'name' => 'Kahama Town',
                'isactive' => 1,
            ),
            164 => 
            array (
                'id' => 165,
                'region_id' => 23,
                'name' => 'Kahama District',
                'isactive' => 1,
            ),
            165 => 
            array (
                'id' => 166,
                'region_id' => 23,
                'name' => 'Kishapu',
                'isactive' => 1,
            ),
            166 => 
            array (
                'id' => 167,
                'region_id' => 23,
                'name' => 'Shinyanga District',
                'isactive' => 1,
            ),
            167 => 
            array (
                'id' => 168,
                'region_id' => 23,
                'name' => 'Shinyanga Municipal',
                'isactive' => 1,
            ),
            168 => 
            array (
                'id' => 169,
                'region_id' => 31,
                'name' => 'Songwe',
                'isactive' => 1,
            ),
            169 => 
            array (
                'id' => 170,
                'region_id' => 31,
                'name' => 'Mbozi',
                'isactive' => 1,
            ),
            170 => 
            array (
                'id' => 171,
                'region_id' => 31,
                'name' => 'Ileje',
                'isactive' => 1,
            ),
            171 => 
            array (
                'id' => 172,
                'region_id' => 31,
                'name' => 'Momba',
                'isactive' => 1,
            ),
        ));
        $this->enableForeignKeys("districts");
        
    }
}