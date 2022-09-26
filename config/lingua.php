<?php

return
    [
        'admin' => [],
        'translator' => [],
        'regex' => [
            'all' => 'all',
            '__()' => "/__\((?:'|\")(.+?)(?:'|\")\)/m",
            'trans()' => "/trans\((?:'|\")(.+?)(?:'|\")\)/m",
        ],
        'regexTags' => "/>([^<\n\r__,{{(.*?)}}]+)</m",
        'regexTagsStart' => "/>([^<\n\r__,]*)(",
        'regexTagsEnd' => ')</m',
        'table-fields' => [
            'string',
            'language',
            'project',
            'translation',
        ],
        'locales-list' => [
            0 => [
                'isolanguagename' => '',
                'nativename' => '',
                'locale' => '',
            ],
            1 => [
                'isolanguagename' => 'Afar',
                'nativename' => 'Afaraf',
                'locale' => 'aa',
            ],
            2 => [
                'isolanguagename' => 'Afrikaans',
                'nativename' => 'Afrikaans',
                'locale' => 'af',
            ],
            3 => [
                'isolanguagename' => 'Akan',
                'nativename' => 'Akan',
                'locale' => 'ak',
            ],
            4 => [
                'isolanguagename' => 'Albanian',
                'nativename' => 'Shqip',
                'locale' => 'sq',
            ],
            5 => [
                'isolanguagename' => 'Amharic',
                'nativename' => 'አማርኛ',
                'locale' => 'am',
            ],
            6 => [
                'isolanguagename' => 'Arabic',
                'nativename' => 'العربية',
                'locale' => 'ar',
            ],
            7 => [
                'isolanguagename' => 'Aragonese',
                'nativename' => 'aragonés',
                'locale' => 'an',
            ],
            8 => [
                'isolanguagename' => 'Armenian',
                'nativename' => 'Հայերեն',
                'locale' => 'hy',
            ],
            9 => [
                'isolanguagename' => 'Assamese',
                'nativename' => 'অসমীয়া',
                'locale' => 'as',
            ],
            10 => [
                'isolanguagename' => 'Avaric',
                'nativename' => 'авар мацӀ, магӀарул мацӀ',
                'locale' => 'av',
            ],
            11 => [
                'isolanguagename' => 'Avestan',
                'nativename' => 'avesta',
                'locale' => 'ae',
            ],
            12 => [
                'isolanguagename' => 'Aymara',
                'nativename' => 'aymar aru',
                'locale' => 'ay',
            ],
            13 => [
                'isolanguagename' => 'Azerbaijani',
                'nativename' => 'azərbaycan dili',
                'locale' => 'az',
            ],
            14 => [
                'isolanguagename' => 'Bambara',
                'nativename' => 'bamanankan',
                'locale' => 'bm',
            ],
            15 => [
                'isolanguagename' => 'Bashkir',
                'nativename' => 'башҡорт теле',
                'locale' => 'ba',
            ],
            16 => [
                'isolanguagename' => 'Basque',
                'nativename' => 'euskara, euskera',
                'locale' => 'eu',
            ],
            17 => [
                'isolanguagename' => 'Belarusian',
                'nativename' => 'беларуская мова',
                'locale' => 'be',
            ],
            18 => [
                'isolanguagename' => 'Bengali',
                'nativename' => 'বাংলা',
                'locale' => 'bn',
            ],
            19 => [
                'isolanguagename' => 'Bihari languages',
                'nativename' => 'भोजपुरी',
                'locale' => 'bh',
            ],
            20 => [
                'isolanguagename' => 'Bislama',
                'nativename' => 'Bislama',
                'locale' => 'bi',
            ],
            21 => [
                'isolanguagename' => 'Bosnian',
                'nativename' => 'bosanski jezik',
                'locale' => 'bs',
            ],
            22 => [
                'isolanguagename' => 'Breton',
                'nativename' => 'brezhoneg',
                'locale' => 'br',
            ],
            23 => [
                'isolanguagename' => 'Bulgarian',
                'nativename' => 'български език',
                'locale' => 'bg',
            ],
            24 => [
                'isolanguagename' => 'Burmese',
                'nativename' => 'ဗမာစာ',
                'locale' => 'my',
            ],
            25 => [
                'isolanguagename' => 'Catalan, Valencian',
                'nativename' => 'català, valencià',
                'locale' => 'ca',
            ],
            26 => [
                'isolanguagename' => 'Chamorro',
                'nativename' => 'Chamoru',
                'locale' => 'ch',
            ],
            27 => [
                'isolanguagename' => 'Chechen',
                'nativename' => 'нохчийн мотт',
                'locale' => 'ce',
            ],
            28 => [
                'isolanguagename' => 'Chichewa, Chewa, Nyanja',
                'nativename' => 'chiCheŵa, chinyanja',
                'locale' => 'ny',
            ],
            29 => [
                'isolanguagename' => 'Chinese',
                'nativename' => '中文 (Zhōngwén), 汉语, 漢語',
                'locale' => 'zh',
            ],
            30 => [
                'isolanguagename' => 'Chuvash',
                'nativename' => 'чӑваш чӗлхи',
                'locale' => 'cv',
            ],
            31 => [
                'isolanguagename' => 'Cornish',
                'nativename' => 'Kernewek',
                'locale' => 'kw',
            ],
            32 => [
                'isolanguagename' => 'Corsican',
                'nativename' => 'corsu, lingua corsa',
                'locale' => 'co',
            ],
            33 => [
                'isolanguagename' => 'Cree',
                'nativename' => 'ᓀᐦᐃᔭᐍᐏᐣ',
                'locale' => 'cr',
            ],
            34 => [
                'isolanguagename' => 'Croatian',
                'nativename' => 'hrvatski jezik',
                'locale' => 'hr',
            ],
            35 => [
                'isolanguagename' => 'Czech',
                'nativename' => 'čeština, český jazyk',
                'locale' => 'cs',
            ],
            36 => [
                'isolanguagename' => 'Danish',
                'nativename' => 'dansk',
                'locale' => 'da',
            ],
            37 => [
                'isolanguagename' => 'Divehi, Dhivehi, Maldivian',
                'nativename' => 'ދިވެހި',
                'locale' => 'dv',
            ],
            38 => [
                'isolanguagename' => 'Dutch, Flemish',
                'nativename' => 'Nederlands, Vlaams',
                'locale' => 'nl',
            ],
            39 => [
                'isolanguagename' => 'Dzongkha',
                'nativename' => 'རྫོང་ཁ',
                'locale' => 'dz',
            ],
            40 => [
                'isolanguagename' => 'English',
                'nativename' => 'English',
                'locale' => 'en',
            ],
            41 => [
                'isolanguagename' => 'Esperanto',
                'nativename' => 'Esperanto',
                'locale' => 'eo',
            ],
            42 => [
                'isolanguagename' => 'Estonian',
                'nativename' => 'eesti, eesti keel',
                'locale' => 'et',
            ],
            43 => [
                'isolanguagename' => 'Ewe',
                'nativename' => 'Eʋegbe',
                'locale' => 'ee',
            ],
            44 => [
                'isolanguagename' => 'Faroese',
                'nativename' => 'føroyskt',
                'locale' => 'fo',
            ],
            45 => [
                'isolanguagename' => 'Fijian',
                'nativename' => 'vosa Vakaviti',
                'locale' => 'fj',
            ],
            46 => [
                'isolanguagename' => 'Finnish',
                'nativename' => 'suomi, suomen kieli',
                'locale' => 'fi',
            ],
            47 => [
                'isolanguagename' => 'French',
                'nativename' => 'français, langue française',
                'locale' => 'fr',
            ],
            48 => [
                'isolanguagename' => 'Fulah',
                'nativename' => 'Fulfulde, Pulaar, Pular',
                'locale' => 'ff',
            ],
            49 => [
                'isolanguagename' => 'Galician',
                'nativename' => 'Galego',
                'locale' => 'gl',
            ],
            50 => [
                'isolanguagename' => 'Georgian',
                'nativename' => 'ქართული',
                'locale' => 'ka',
            ],
            51 => [
                'isolanguagename' => 'German',
                'nativename' => 'Deutsch',
                'locale' => 'de',
            ],
            52 => [
                'isolanguagename' => 'Greek, Modern (1453–)',
                'nativename' => 'ελληνικά',
                'locale' => 'el',
            ],
            53 => [
                'isolanguagename' => 'Guarani',
                'nativename' => 'Avañe\'ẽ',
                'locale' => 'gn',
            ],
            54 => [
                'isolanguagename' => 'Gujarati',
                'nativename' => 'ગુજરાતી',
                'locale' => 'gu',
            ],
            55 => [
                'isolanguagename' => 'Haitian, Haitian Creole',
                'nativename' => 'Kreyòl ayisyen',
                'locale' => 'ht',
            ],
            56 => [
                'isolanguagename' => 'Hausa',
                'nativename' => '(Hausa) هَوُسَ',
                'locale' => 'ha',
            ],
            57 => [
                'isolanguagename' => 'Hebrew',
                'nativename' => 'עברית',
                'locale' => 'he',
            ],
            58 => [
                'isolanguagename' => 'Herero',
                'nativename' => 'Otjiherero',
                'locale' => 'hz',
            ],
            59 => [
                'isolanguagename' => 'Hindi',
                'nativename' => 'हिन्दी, हिंदी',
                'locale' => 'hi',
            ],
            60 => [
                'isolanguagename' => 'Hiri Motu',
                'nativename' => 'Hiri Motu',
                'locale' => 'ho',
            ],
            61 => [
                'isolanguagename' => 'Hungarian',
                'nativename' => 'magyar',
                'locale' => 'hu',
            ],
            62 => [
                'isolanguagename' => 'Interlingua (International Auxiliary Language Association)',
                'nativename' => 'Interlingua',
                'locale' => 'ia',
            ],
            63 => [
                'isolanguagename' => 'Indonesian',
                'nativename' => 'Bahasa Indonesia',
                'locale' => 'id',
            ],
            64 => [
                'isolanguagename' => 'Interlingue, Occidental',
                'nativename' => '(originally:) *Occidental*, (after WWII:) *Interlingue*',
                'locale' => 'ie',
            ],
            65 => [
                'isolanguagename' => 'Irish',
                'nativename' => 'Gaeilge',
                'locale' => 'ga',
            ],
            66 => [
                'isolanguagename' => 'Igbo',
                'nativename' => 'Asụsụ Igbo',
                'locale' => 'ig',
            ],
            67 => [
                'isolanguagename' => 'Inupiaq',
                'nativename' => 'Iñupiaq, Iñupiatun',
                'locale' => 'ik',
            ],
            68 => [
                'isolanguagename' => 'Ido',
                'nativename' => 'Ido',
                'locale' => 'io',
            ],
            69 => [
                'isolanguagename' => 'Icelandic',
                'nativename' => 'Íslenska',
                'locale' => 'is',
            ],
            70 => [
                'isolanguagename' => 'Italian',
                'nativename' => 'Italiano',
                'locale' => 'it',
            ],
            71 => [
                'isolanguagename' => 'Inuktitut',
                'nativename' => 'ᐃᓄᒃᑎᑐᑦ',
                'locale' => 'iu',
            ],
            72 => [
                'isolanguagename' => 'Japanese',
                'nativename' => '日本語 (にほんご)',
                'locale' => 'ja',
            ],
            73 => [
                'isolanguagename' => 'Javanese',
                'nativename' => 'ꦧꦱꦗꦮ, Basa Jawa',
                'locale' => 'jv',
            ],
            74 => [
                'isolanguagename' => 'Kalaallisut, Greenlandic',
                'nativename' => 'kalaallisut, kalaallit oqaasii',
                'locale' => 'kl',
            ],
            75 => [
                'isolanguagename' => 'Kannada',
                'nativename' => 'ಕನ್ನಡ',
                'locale' => 'kn',
            ],
            76 => [
                'isolanguagename' => 'Kanuri',
                'nativename' => 'Kanuri',
                'locale' => 'kr',
            ],
            77 => [
                'isolanguagename' => 'Kashmiri',
                'nativename' => 'कश्मीरी, كشميري‎',
                'locale' => 'ks',
            ],
            78 => [
                'isolanguagename' => 'Kazakh',
                'nativename' => 'қазақ тілі',
                'locale' => 'kk',
            ],
            79 => [
                'isolanguagename' => 'Central Khmer',
                'nativename' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
                'locale' => 'km',
            ],
            80 => [
                'isolanguagename' => 'Kikuyu, Gikuyu',
                'nativename' => 'Gĩkũyũ',
                'locale' => 'ki',
            ],
            81 => [
                'isolanguagename' => 'Kinyarwanda',
                'nativename' => 'Ikinyarwanda',
                'locale' => 'rw',
            ],
            82 => [
                'isolanguagename' => 'Kirghiz, Kyrgyz',
                'nativename' => 'Кыргызча, Кыргыз тили',
                'locale' => 'ky',
            ],
            83 => [
                'isolanguagename' => 'Komi',
                'nativename' => 'коми кыв',
                'locale' => 'kv',
            ],
            84 => [
                'isolanguagename' => 'Kongo',
                'nativename' => 'Kikongo',
                'locale' => 'kg',
            ],
            85 => [
                'isolanguagename' => 'Korean',
                'nativename' => '한국어',
                'locale' => 'ko',
            ],
            86 => [
                'isolanguagename' => 'Kurdish',
                'nativename' => '*Kurdî*, کوردی‎',
                'locale' => 'ku',
            ],
            87 => [
                'isolanguagename' => 'Kuanyama, Kwanyama',
                'nativename' => 'Kuanyama',
                'locale' => 'kj',
            ],
            88 => [
                'isolanguagename' => 'Latin',
                'nativename' => 'latine, lingua latina',
                'locale' => 'la',
            ],
            89 => [
                'isolanguagename' => 'Luxembourgish, Letzeburgesch',
                'nativename' => 'Lëtzebuergesch',
                'locale' => 'lb',
            ],
            90 => [
                'isolanguagename' => 'Ganda',
                'nativename' => 'Luganda',
                'locale' => 'lg',
            ],
            91 => [
                'isolanguagename' => 'Limburgan, Limburger, Limburgish',
                'nativename' => 'Limburgs',
                'locale' => 'li',
            ],
            92 => [
                'isolanguagename' => 'Lingala',
                'nativename' => 'Lingála',
                'locale' => 'ln',
            ],
            93 => [
                'isolanguagename' => 'Lao',
                'nativename' => 'ພາສາລາວ',
                'locale' => 'lo',
            ],
            94 => [
                'isolanguagename' => 'Lithuanian',
                'nativename' => 'lietuvių kalba',
                'locale' => 'lt',
            ],
            95 => [
                'isolanguagename' => 'Luba-Katanga',
                'nativename' => 'Kiluba',
                'locale' => 'lu',
            ],
            96 => [
                'isolanguagename' => 'Latvian',
                'nativename' => 'latviešu valoda',
                'locale' => 'lv',
            ],
            97 => [
                'isolanguagename' => 'Manx',
                'nativename' => 'Gaelg, Gailck',
                'locale' => 'gv',
            ],
            98 => [
                'isolanguagename' => 'Macedonian',
                'nativename' => 'македонски јазик',
                'locale' => 'mk',
            ],
            99 => [
                'isolanguagename' => 'Malagasy',
                'nativename' => 'fiteny malagasy',
                'locale' => 'mg',
            ],
            100 => [
                'isolanguagename' => 'Malay',
                'nativename' => '*Bahasa Melayu*, بهاس ملايو‎',
                'locale' => 'ms',
            ],
            101 => [
                'isolanguagename' => 'Malayalam',
                'nativename' => 'മലയാളം',
                'locale' => 'ml',
            ],
            102 => [
                'isolanguagename' => 'Maltese',
                'nativename' => 'Malti',
                'locale' => 'mt',
            ],
            103 => [
                'isolanguagename' => 'Maori',
                'nativename' => 'te reo Māori',
                'locale' => 'mi',
            ],
            104 => [
                'isolanguagename' => 'Marathi',
                'nativename' => 'मराठी',
                'locale' => 'mr',
            ],
            105 => [
                'isolanguagename' => 'Marshallese',
                'nativename' => 'Kajin M̧ajeļ',
                'locale' => 'mh',
            ],
            106 => [
                'isolanguagename' => 'Mongolian',
                'nativename' => 'Монгол хэл',
                'locale' => 'mn',
            ],
            107 => [
                'isolanguagename' => 'Nauru',
                'nativename' => 'Dorerin Naoero',
                'locale' => 'na',
            ],
            108 => [
                'isolanguagename' => 'Navajo, Navaho',
                'nativename' => 'Diné bizaad',
                'locale' => 'nv',
            ],
            109 => [
                'isolanguagename' => 'North Ndebele',
                'nativename' => 'isiNdebele',
                'locale' => 'nd',
            ],
            110 => [
                'isolanguagename' => 'Nepali',
                'nativename' => 'नेपाली',
                'locale' => 'ne',
            ],
            111 => [
                'isolanguagename' => 'Ndonga',
                'nativename' => 'Owambo',
                'locale' => 'ng',
            ],
            112 => [
                'isolanguagename' => 'Norwegian Bokmål',
                'nativename' => 'Norsk Bokmål',
                'locale' => 'nb',
            ],
            113 => [
                'isolanguagename' => 'Norwegian Nynorsk',
                'nativename' => 'Norsk Nynorsk',
                'locale' => 'nn',
            ],
            114 => [
                'isolanguagename' => 'Norwegian',
                'nativename' => 'Norsk',
                'locale' => 'no',
            ],
            115 => [
                'isolanguagename' => 'Sichuan Yi, Nuosu',
                'nativename' => 'ꆈꌠ꒿ Nuosuhxop',
                'locale' => 'ii',
            ],
            116 => [
                'isolanguagename' => 'South Ndebele',
                'nativename' => 'isiNdebele',
                'locale' => 'nr',
            ],
            117 => [
                'isolanguagename' => 'Occitan',
                'nativename' => 'occitan, lenga d\'òc',
                'locale' => 'oc',
            ],
            118 => [
                'isolanguagename' => 'Ojibwa',
                'nativename' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
                'locale' => 'oj',
            ],
            119 => [
                'isolanguagename' => 'Church Slavic, Old Slavonic, Church Slavonic, Old Bulgarian,
Old Church Slavonic',
                'nativename' => 'ѩзыкъ словѣньскъ',
                'locale' => 'cu',
            ],
            120 => [
                'isolanguagename' => 'Oromo',
                'nativename' => 'Afaan Oromoo',
                'locale' => 'om',
            ],
            121 => [
                'isolanguagename' => 'Oriya',
                'nativename' => 'ଓଡ଼ିଆ',
                'locale' => 'or',
            ],
            122 => [
                'isolanguagename' => 'Ossetian, Ossetic',
                'nativename' => 'ирон æвзаг',
                'locale' => 'os',
            ],
            123 => [
                'isolanguagename' => 'Punjabi, Panjabi',
                'nativename' => 'ਪੰਜਾਬੀ, پنجابی‎',
                'locale' => 'pa',
            ],
            124 => [
                'isolanguagename' => 'Pali',
                'nativename' => 'पालि, पाळि',
                'locale' => 'pi',
            ],
            125 => [
                'isolanguagename' => 'Persian',
                'nativename' => 'فارسی',
                'locale' => 'fa',
            ],
            126 => [
                'isolanguagename' => 'Polish',
                'nativename' => 'język polski, polszczyzna',
                'locale' => 'pl',
            ],
            127 => [
                'isolanguagename' => 'Pashto, Pushto',
                'nativename' => 'پښتو',
                'locale' => 'ps',
            ],
            128 => [
                'isolanguagename' => 'Portuguese',
                'nativename' => 'Português',
                'locale' => 'pt',
            ],
            129 => [
                'isolanguagename' => 'Quechua',
                'nativename' => 'Runa Simi, Kichwa',
                'locale' => 'qu',
            ],
            130 => [
                'isolanguagename' => 'Romansh',
                'nativename' => 'Rumantsch Grischun',
                'locale' => 'rm',
            ],
            131 => [
                'isolanguagename' => 'Rundi',
                'nativename' => 'Ikirundi',
                'locale' => 'rn',
            ],
            132 => [
                'isolanguagename' => 'Romanian, Moldavian, Moldovan',
                'nativename' => 'Română',
                'locale' => 'ro',
            ],
            133 => [
                'isolanguagename' => 'Russian',
                'nativename' => 'русский',
                'locale' => 'ru',
            ],
            134 => [
                'isolanguagename' => 'Sanskrit',
                'nativename' => 'संस्कृतम्',
                'locale' => 'sa',
            ],
            135 => [
                'isolanguagename' => 'Sardinian',
                'nativename' => 'sardu',
                'locale' => 'sc',
            ],
            136 => [
                'isolanguagename' => 'Sindhi',
                'nativename' => 'सिन्धी, سنڌي، سندھی‎',
                'locale' => 'sd',
            ],
            137 => [
                'isolanguagename' => 'Northern Sami',
                'nativename' => 'Davvisámegiella',
                'locale' => 'se',
            ],
            138 => [
                'isolanguagename' => 'Samoan',
                'nativename' => 'gagana fa\'a Samoa',
                'locale' => 'sm',
            ],
            139 => [
                'isolanguagename' => 'Sango',
                'nativename' => 'yângâ tî sängö',
                'locale' => 'sg',
            ],
            140 => [
                'isolanguagename' => 'Serbian',
                'nativename' => 'српски језик',
                'locale' => 'sr',
            ],
            141 => [
                'isolanguagename' => 'Gaelic, Scottish Gaelic',
                'nativename' => 'Gàidhlig',
                'locale' => 'gd',
            ],
            142 => [
                'isolanguagename' => 'Shona',
                'nativename' => 'chiShona',
                'locale' => 'sn',
            ],
            143 => [
                'isolanguagename' => 'Sinhala, Sinhalese',
                'nativename' => 'සිංහල',
                'locale' => 'si',
            ],
            144 => [
                'isolanguagename' => 'Slovak',
                'nativename' => 'Slovenčina, Slovenský Jazyk',
                'locale' => 'sk',
            ],
            145 => [
                'isolanguagename' => 'Slovenian',
                'nativename' => 'Slovenski Jezik, Slovenščina',
                'locale' => 'sl',
            ],
            146 => [
                'isolanguagename' => 'Somali',
                'nativename' => 'Soomaaliga, af Soomaali',
                'locale' => 'so',
            ],
            147 => [
                'isolanguagename' => 'Southern Sotho',
                'nativename' => 'Sesotho',
                'locale' => 'st',
            ],
            148 => [
                'isolanguagename' => 'Spanish, Castilian',
                'nativename' => 'Español',
                'locale' => 'es',
            ],
            149 => [
                'isolanguagename' => 'Sundanese',
                'nativename' => 'Basa Sunda',
                'locale' => 'su',
            ],
            150 => [
                'isolanguagename' => 'Swahili',
                'nativename' => 'Kiswahili',
                'locale' => 'sw',
            ],
            151 => [
                'isolanguagename' => 'Swati',
                'nativename' => 'SiSwati',
                'locale' => 'ss',
            ],
            152 => [
                'isolanguagename' => 'Swedish',
                'nativename' => 'Svenska',
                'locale' => 'sv',
            ],
            153 => [
                'isolanguagename' => 'Tamil',
                'nativename' => 'தமிழ்',
                'locale' => 'ta',
            ],
            154 => [
                'isolanguagename' => 'Telugu',
                'nativename' => 'తెలుగు',
                'locale' => 'te',
            ],
            155 => [
                'isolanguagename' => 'Tajik',
                'nativename' => 'тоҷикӣ, *toçikī*, تاجیکی‎',
                'locale' => 'tg',
            ],
            156 => [
                'isolanguagename' => 'Thai',
                'nativename' => 'ไทย',
                'locale' => 'th',
            ],
            157 => [
                'isolanguagename' => 'Tigrinya',
                'nativename' => 'ትግርኛ',
                'locale' => 'ti',
            ],
            158 => [
                'isolanguagename' => 'Tibetan',
                'nativename' => 'བོད་ཡིག',
                'locale' => 'bo',
            ],
            159 => [
                'isolanguagename' => 'Turkmen',
                'nativename' => 'Türkmen, Түркмен',
                'locale' => 'tk',
            ],
            160 => [
                'isolanguagename' => 'Tagalog',
                'nativename' => 'Wikang Tagalog',
                'locale' => 'tl',
            ],
            161 => [
                'isolanguagename' => 'Tswana',
                'nativename' => 'Setswana',
                'locale' => 'tn',
            ],
            162 => [
                'isolanguagename' => 'Tonga (Tonga Islands)',
                'nativename' => 'Faka Tonga',
                'locale' => 'to',
            ],
            163 => [
                'isolanguagename' => 'Turkish',
                'nativename' => 'Türkçe',
                'locale' => 'tr',
            ],
            164 => [
                'isolanguagename' => 'Tsonga',
                'nativename' => 'Xitsonga',
                'locale' => 'ts',
            ],
            165 => [
                'isolanguagename' => 'Tatar',
                'nativename' => 'татар теле, *tatar tele*',
                'locale' => 'tt',
            ],
            166 => [
                'isolanguagename' => 'Twi',
                'nativename' => 'Twi',
                'locale' => 'tw',
            ],
            167 => [
                'isolanguagename' => 'Tahitian',
                'nativename' => 'Reo Tahiti',
                'locale' => 'ty',
            ],
            168 => [
                'isolanguagename' => 'Uighur, Uyghur',
                'nativename' => 'ئۇيغۇرچە‎, *Uyghurche*',
                'locale' => 'ug',
            ],
            169 => [
                'isolanguagename' => 'Ukrainian',
                'nativename' => 'Українська',
                'locale' => 'uk',
            ],
            170 => [
                'isolanguagename' => 'Urdu',
                'nativename' => 'اردو',
                'locale' => 'ur',
            ],
            171 => [
                'isolanguagename' => 'Uzbek',
                'nativename' => '*Oʻzbek*, Ўзбек, أۇزبېك‎',
                'locale' => 'uz',
            ],
            172 => [
                'isolanguagename' => 'Venda',
                'nativename' => 'Tshivenḓa',
                'locale' => 've',
            ],
            173 => [
                'isolanguagename' => 'Vietnamese',
                'nativename' => 'Tiếng Việt',
                'locale' => 'vi',
            ],
            174 => [
                'isolanguagename' => 'Volapük',
                'nativename' => 'Volapük',
                'locale' => 'vo',
            ],
            175 => [
                'isolanguagename' => 'Walloon',
                'nativename' => 'Walon',
                'locale' => 'wa',
            ],
            176 => [
                'isolanguagename' => 'Welsh',
                'nativename' => 'Cymraeg',
                'locale' => 'cy',
            ],
            177 => [
                'isolanguagename' => 'Wolof',
                'nativename' => 'Wollof',
                'locale' => 'wo',
            ],
            178 => [
                'isolanguagename' => 'Western Frisian',
                'nativename' => 'Frysk',
                'locale' => 'fy',
            ],
            179 => [
                'isolanguagename' => 'Xhosa',
                'nativename' => 'isiXhosa',
                'locale' => 'xh',
            ],
            180 => [
                'isolanguagename' => 'Yiddish',
                'nativename' => 'ייִדיש',
                'locale' => 'yi',
            ],
            181 => [
                'isolanguagename' => 'Yoruba',
                'nativename' => 'Yorùbá',
                'locale' => 'yo',
            ],
            182 => [
                'isolanguagename' => 'Zhuang, Chuang',
                'nativename' => 'Saɯ cueŋƅ, Saw cuengh',
                'locale' => 'za',
            ],
            183 => [
                'isolanguagename' => 'Zulu',
                'nativename' => 'isiZulu',
                'locale' => 'zu',
            ],
            184 => [
                'isolanguagename' => 'Abkhazian',
                'nativename' => 'аҧсуа бызшәа, аҧсшәа',
                'locale' => 'ab',
            ],
        ],
    ];
