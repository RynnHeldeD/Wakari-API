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
    "categories": [
        {
            "id":2,
            "name":"Habitation",
            "created_at":null,
            "updated_at":null
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
```
PUT > http://wakari-api.huitiemeciel.info/word?data={"kanji":"家","kana":"いえ","romaji":"ue","meaning":"maison","notes":"Uniquement le terme pour 'Maison', 'Appartement' se dit autrement.","categories":["maison","habitation"]}
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
    "id": 747
}
```
**Failure**
```json
{
  "Error": "No data provided."
}
```

### POST /word
Update a word with data provided.
The updated word is the one specified with parameter "id".
```
POST > http://wakari-api.huitiemeciel.info/word?data={"id":747,"kanji":"#","kana":"kana","romaji":"notTheSame","meaning":"anotherMeaning","notes":"Some notes.","categories":["new","category"]}
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
    "created_at": "2017-02-23 23:04:46"
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
		"name":"Maison",
		"created_at":null,
		"updated_at":null
	},
	{
		"id":2,
		"name":"Habitation",
		"created_at":null,
		"updated_at":null
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
	"name":"Maison",
	"created_at":null,
	"updated_at":null
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
```
PUT > http://wakari-api.huitiemeciel.info/theme?data={"name":"Alimentation"}
```
**Success**
```json
{
	"id":3,
	"name":"Alimentation",
    "created_at": "2017-02-23 23:04:46",
	"updated_at": "2017-02-23 23:04:46",
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
```
POST > http://wakari-api.huitiemeciel.info/theme?data={"id":3,"name":"Nourriture"}
```
```json
{
    "id":3,
	"name":"Alimentation",
    "created_at": "2017-02-23 23:04:46",
    "updated_at": "2017-02-23 23:11:21",
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



