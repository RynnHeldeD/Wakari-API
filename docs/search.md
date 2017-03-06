# Search
Everything related to seach feature.

## POST /search
Return all words and themes whose romaji and name begin with the provided pattern ; and words whose meaning contains the pattern.
```
POST > http://wakari-api.huitiemeciel.info/search?data={"pattern":"ani"}
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


## POST /search/autocomplete
Return minimal information of words and themes whose romaji and name begin with the provided pattern ; and words whose meaning contains the pattern.
```
POST > http://wakari-api.huitiemeciel.info/search/autocomplete?data={"pattern":"ani"}
```
**Success**
```json
[
  {
    "id":463,
    "name":"animal",
    "type":"word"
  },
  {
    "id":508,
    "name":"anim\u00e9 (en parlant d'une ville, d'une rue...)",
    "type":"word"
  },
  {
    "id":6,
    "name":"Animal",
    "type":"theme"
  }
]
```
**Failure**
```json
{
  "Error": "No pattern provided."
}
```
