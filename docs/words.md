# Words
Everything about words.

## GET /word
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

## GET /word/{id}
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

## PUT /word
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

## POST /word
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

## DELETE /word/{id}
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

## GET /words/like/{pattern}/{method?}/{type?}
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

# Words transliteration
Everything about converting words from a language to another.

## POST /word/convert/romaji
Convert some kana (hiragana or katakana) to romaji (latin) characters.
```
POST > http://wakari-api.huitiemeciel.info/word/convert/romaji?data={"どうも ありがとう ございます"}
```
```json
{
  "result": "doumo arigatou gozaimasu"
}
```
```json
{
  "Error": "No data provided."
}
```

## POST /word/convert/katakana
Convert some romaji (latin) to katakana characters.
```
POST > http://wakari-api.huitiemeciel.info/word/convert/katakana?data={"Nicola"}
```
```json
{
  "result": "ニコラ"
}
```
```json
{
  "Error": "No data provided."
}
```

## POST /word/convert/hiragana
Convert some romaji (latin) to hiragana characters.
```
POST > http://wakari-api.huitiemeciel.info/word/convert/hiragana?data={"Nicola"}
```
```json
{
  "result": "にこら"
}
```
```json
{
  "Error": "No data provided."
}
```


# Words tools
Everything about tools and automation for words.

## GET /words/generation/romaji/{forceAll?}
Update database and set romaji field for words without translation. 
Process everyword again if parameter forceAll is provided and is true.
Return the number of updated words.
```
GET > http://wakari-api.huitiemeciel.info/words/generation/romaji/
GET > http://wakari-api.huitiemeciel.info/words/generation/romaji/true
```
```json
{
  "processed":"764"
}
```