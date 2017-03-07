# Pages
Everything about pages.

## GET /page
Return all existing pages.
```
GET > http://wakari-api.huitiemeciel.info/page
```
```json
[
    {
        "id":1,
        "name":"Feminin / Masculin",
        "content":"Sauf les escargots qui sont les deux."
    },
    {
        "id":2,
        "name":"Singulier / Pluriel",
        "content":"Quand y en a plus, c'est mieux."
    },
    {
        "id":3,
        "name":"Grammaire",
        "content":"De la grammaire whou",
    }
]
```

## GET /page/{id}
Return page with specified id.
```
GET > http://wakari-api.huitiemeciel.info/page/3
```
**Success**
```json
{
    "name":"Grammaire",
    "content":"De la grammaire whou",
    "id":6,
    "themes": [
        {
            "id":1,
            "name":"Cours"
        }
    ],
    "pages": [
        {
            "id":1,
            "name":"Feminin / Masculin",
            "content":"Sauf les escargots qui sont les deux."
        },
        {
            "id":2,
            "name":"Singulier / Pluriel",
            "content":"Quand y en a plus, c'est mieux."
        }
    ]
}
```
**Failure**
```json
{
  "Error": "No page with id found."
}
```

## PUT /page
Create a page with data provided.
Return the created page with newly attributed id.
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
PUT > http://wakari-api.huitiemeciel.info/page?data={"name": "Grammaire", "content": "De la grammaire whou", "themes":[{"id":1}], "pages":[{"id":1}, {"id":2}]}
```
**Success**
```json
{
    "name":"Grammaire",
    "content":"De la grammaire whou",
    "id":6,
    "themes": [
        {
            "id":1,
            "name":"Cours"
        }
    ],
    "pages": [
        {
            "id":1,
            "name":"Feminin / Masculin",
            "content":"Sauf les escargots qui sont les deux."
        },
        {
            "id":2,
            "name":"Singulier / Pluriel",
            "content":"Quand y en a plus, c'est mieux."
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
If provided theme is not found, it is not added to the page.

## POST /page
Update a page with data provided.
The updated page is the one specified with parameter "id".
Take care not to add an extra '/' at the end of the url as it won't match this route.
```
POST > http://wakari-api.huitiemeciel.info/page?data={"id":1, "name": "Grammaire", "content": "De la grammaire beurk", "themes":[{"id":1}], "pages":[{"id":2}]}
```
```json
{
    "name":"Grammaire",
    "content":"De la grammaire beurk",
    "id":1,
    "themes": [
        {
            "id":1,
            "name":"Cours"
        }
    ],
    "pages": [
        {
            "id":2,
            "name":"Singulier / Pluriel",
            "content":"Quand y en a plus, c'est mieux."
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
  "Error": "No page with id found."
}
```
If provided theme is not found, it is not added to the page. Updating a page replace all his themes with new ones.

## DELETE /page/{id}
Delete a page with id provided.
```
DELETE > http://wakari-api.huitiemeciel.info/page/10
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
  "Error": "No page with id found."
}
```

## GET /pages/like/{pattern}/{method?}
Return all pages matching the provided pattern. The search method can be 'begins' (default) or 'contains' and can be narrowed to look for 'all' elements (default), 'romaji' only or 'meaning' only.
Note the 's' at '/pages/...'
```
GET > http://wakari-api.huitiemeciel.info/pages/like/mmai/contains
```
**Success**
```json
[
	{
        "name":"Grammaire",
        "content":"De la grammaire beurk",
        "id":1
    }
]
```
**Failure**
```json
{
  "Error": "No pattern provided."
}
```