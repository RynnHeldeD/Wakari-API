# Themes
Everything about the themes, groups of words under a same label.

## GET /theme
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

## GET /theme/{id}
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

## PUT /theme
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

## POST /theme
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


## DELETE /theme/{id}
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

## GET /theme/{key}/words
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

## GET /themes/like/{pattern}/{method?}
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
