# Wakari-API
The API for Wakari, the Japanese dictionary project.


## Words 

### GET /word
Return all existing words.
```
GET > http://wakari-api.huitiemeciel.info/word
```
```json
[
    {
        "id":1,
        "kanji":"\u55da\u547c",
        "kana":"\u3042\u3042",
        "romaji":"aa",
        "meaning":"ah !, oh !, hey!",
        "notes":"Blablabla prout!",
        "updated_at":null,
        "created_at":null
    },
    {
        "id":2,
        "kanji":"\u6328\u62f6\u3059\u308b",
        "kana":"\u3042\u3044\u3055\u3064\u3059\u308b",
        "romaji":"aisatsusuru",
        "meaning":"saluer",
        "notes":null,
        "updated_at":null,
        "created_at":null
    }
]
```

### GET /word/{id}
Return word with specified id.
```
GET > http://wakari-api.huitiemeciel.info/word/2
```
**Success**
```json
{
    "id":2,
    "kanji":"\u6328\u62f6\u3059\u308b",
    "kana":"\u3042\u3044\u3055\u3064\u3059\u308b",
    "romaji":"aisatsusuru",
    "meaning":"saluer",
    "notes":null,
    "updated_at":null,
    "created_at":null,
    "themes": [
        {
            "id":2,
            "name":"Habitation"
        }
    ]
}
```
**Failure**
```json
{
  "Error": "No word with id found."
}
```

### PUT /word
Create a word with data provided.
Return the created word with newly attributed id.
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
PUT > http://wakari-api.huitiemeciel.info/word?data={"kanji":"家","kana":"いえ","romaji":"ue","meaning":"maison","notes":"Uniquement le terme pour 'Maison', 'Appartement' se dit autrement.","themes":[{"id":1, "name":"maison"},{"id":2, "name":"habitation"}]}
```
**Success**
```json
{
    "kanji": "家",
    "kana": "いえ",
    "romaji": "ue",
    "meaning": "maison",
    "notes": "Uniquement le terme pour 'Maison', 'Appartement' se dit autrement.",
    "updated_at": "2017-02-23 23:04:46",
    "created_at": "2017-02-23 23:04:46",
    "id": 747,
    "themes": [
        {
             "id": 1,
             "name": "maison"
        },
	{
             "id": 2,
             "name": "Habitation"
        }
    ]
}
```
**Failure**
```json
{
  "Error": "No data provided."
}
```
If provided theme is not found, it is not added to the word.

### POST /word
Update a word with data provided.
The updated word is the one specified with parameter "id".
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
POST > http://wakari-api.huitiemeciel.info/word?data={"id":747,"kanji":"#","kana":"kana","romaji":"notTheSame","meaning":"anotherMeaning","notes":"Some notes.","themes":[{"id":3, "name":"new"},{"id":4, "name":"category"}]}
```
```json
{
    "id": 747,
    "kanji": "kanji",
    "kana": "kana",
    "romaji": "notTheSame",
    "meaning": "anotherMeaning",
    "notes": "Some notes.",
    "updated_at": "2017-02-23 23:11:21",
    "created_at": "2017-02-23 23:04:46",
    "themes": [
        {
             "id": 3,
             "name": "new"
        },
	{
             "id": 4,
             "name": "Category"
        }
    ]
}
```
```json
{
  "Error": "No data provided."
}
```
```json
{
  "Error": "No word with id found."
}
```
If provided theme is not found, it is not added to the word. Updating a word replace all his themes with new ones.

### DELETE /word/{id}
Delete a word with id provided.
```
DELETE > http://wakari-api.huitiemeciel.info/word/747
```

**Success**
```json
1
```
**Failure**
```json
0
```
```json
{
  "Error": "No word with id found."
}
```

### GET /words/like/{pattern}/{method?}/{type?}
Return all words matching the provided pattern. The search method can be 'begins' (default) or 'contains' and can be narrowed to look for 'all' elements (default), 'romaji' only or 'meaning' only.
Note the 's' at '/words/...'
```
GET > http://wakari-api.huitiemeciel.info/words/like/a/contains/romaji
```
**Success**
```json
[
	{
		"id":2,
		"kanji":"\u6328\u62f6\u3059\u308b",
		"kana":"\u3042\u3044\u3055\u3064\u3059\u308b",
		"romaji":"aisatsusuru",
		"meaning":"saluer",
		"notes":"",
		"created_at":null,
		"updated_at":null
	},
	{
		"id":9,
		"kanji":"\u79cb",
		"kana":"\u3042\u304d",
		"romaji":"a",
		"meaning":"automne",
		"notes":"abcd",
		"created_at":null,
		"updated_at":null
	}
]
```
**Failure**
```json
{
  "Error": "No pattern provided."
}
```

## Themes

### GET /theme
Return all existing themes.
```
GET > http://wakari-api.huitiemeciel.info/theme
```
```json
[
	{
		"id":1,
		"name":"Maison"
	},
	{
		"id":2,
		"name":"Habitation"
	}
]
```

### GET /theme/{id}
Return theme with specified id.
```
GET > http://wakari-api.huitiemeciel.info/theme/1
```
**Success**
```json
{
	"id":1,
	"name":"Maison"
},
```
**Failure**
```json
{
  "Error": "No theme with id found."
}
```

### PUT /theme
Create a theme with data provided.
Return the created theme with newly attributed id.
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
PUT > http://wakari-api.huitiemeciel.info/theme?data={"name":"Alimentation"}
```
**Success**
```json
{
	"id":3,
	"name":"Alimentation"
},
```
**Failure**
```json
{
  "Error": "No data provided."
}
```

### POST /theme
Update a theme with data provided.
The updated theme is the one specified with parameter "id".
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
POST > http://wakari-api.huitiemeciel.info/theme?data={"id":3,"name":"Nourriture"}
```
```json
{
    "id":3,
    "name":"Alimentation"
}
```
```json
{
  "Error": "No data provided."
}
```
```json
{
  "Error": "No theme with id found."
}
```


### DELETE /theme/{id}
Delete a theme with id provided.
```
DELETE > http://wakari-api.huitiemeciel.info/theme/3
```

**Success**
```json
1
```
**Failure**
```json
0
```
```json
{
  "Error": "No theme with id found."
}
```

### GET /theme/{key}/words
Get all words related to theme specified by key.
Key can be :
- theme's id
- theme's name (case insensitive)
```
GET > http://wakari-api.huitiemeciel.info/theme/1/words
GET > http://wakari-api.huitiemeciel.info/theme/maison/words
GET > http://wakari-api.huitiemeciel.info/theme/Maison/words
```

**Success**
```json
[]
```
```json
[
	{
		"id":15,
		"kanji":"\u660e\u5f8c\u65e5",
		"kana":"\u3042\u3055\u3063\u3066",
		"romaji":"",
		"meaning":"Cabane",
		"notes":"Uniquement en bois",
		"created_at":"2017-02-23 23:04:46",
		"updated_at":"2017-02-23 23:04:46"
	}
]
```
**Failure**
```json
{
  "Error": "No theme found with key provided."
}
```
```json
{
  "Error": "No key provided."
}
```

### GET /themes/like/{pattern}/{method?}
Return all themes matching the provided pattern. The search method can be 'begins' (default) or 'contains'.
Note the 's' at '/themes/...'
```
GET > http://wakari-api.huitiemeciel.info/themes/like/ai/contains
```
**Success**
```json
[
 	{
		"id": 1,
    		"name": "Maison"
  	},
  	{
    		"id": 3,
    		"name": "Saison"
  	}
]
```
**Failure**
```json
{
  "Error": "No pattern provided."
}
```

## Search

### GET /search/{pattern}
Return all words and themes whose romaji and name begin with the provided pattern ; and words whose meaning contains the pattern.
```
GET > http://wakari-api.huitiemeciel.info/search/ani
```
**Success**
```json
{
  "romaji": [
    {
      "id": 31,
      "kanji": "兄",
      "kana": "あに",
      "romaji": "ani",
      "meaning": "grand-frère",
      "notes": "",
      "created_at": null,
      "updated_at": null
    }
  ],
  "meanings": [
    {
      "id": 137,
      "kanji": "お弁当",
      "kana": "おべんとう",
      "romaji": "",
      "meaning": "bentô, panier-repas japonais",
      "notes": "",
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 139,
      "kanji": "お巡りさん",
      "kana": "おまわりさん",
      "romaji": "",
      "meaning": "policier (désigné de manière amicale)",
      "notes": "",
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 458,
      "kanji": "如何",
      "kana": "どう",
      "romaji": "",
      "meaning": "comment ?, de quelle manière ?",
      "notes": "",
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 463,
      "kanji": "動物",
      "kana": "どうぶつ",
      "romaji": "",
      "meaning": "animal",
      "notes": "",
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 508,
      "kanji": "賑やか",
      "kana": "にぎやか",
      "romaji": "",
      "meaning": "animé (en parlant d'une ville, d'une rue...)",
      "notes": "",
      "created_at": null,
      "updated_at": null
    },
    {
      "id": 569,
      "kanji": "匹",
      "kana": "ひき",
      "romaji": "",
      "meaning": "compteur pour les petits animaux",
      "notes": "",
      "created_at": null,
      "updated_at": null
    }
  ],
  "themes": [
    {
      "id": 6,
      "name": "Animal"
    }
  ]
}
```
**Failure**
```json
{
  "Error": "No pattern provided."
}
```
