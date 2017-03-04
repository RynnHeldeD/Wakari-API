# Search
Everything related to seach feature.

## GET /search/{pattern}
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
