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
}
```

### GET /word/{id}
Return word with specified id.
```
http://wakari-api.huitiemeciel.info/word/2
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
    "created_at":null
}
```
**Failure**
```json
{
  "Error": "No word with id found."
}
```

### PUT /word
Update a word with data provided.
The updated word is the one specified with parameter "id".
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
  "Error": "No word with id found."
}
```

### POST /word
Create a word with data provided.
Return the created word with newly attributed id.
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


### DELETE /word
Delete a word with id provided.
```
DELETE > http://wakari-api.huitiemeciel.info/word?data={"id":747}
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
