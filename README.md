# HORUS MUSIC

## START THE APP
- STEP-1: download the repo
- STEP-2: update composer (composer update -o --no-dev)
- STEP-3: start the server (php -S 127.0.0.1:8000 -t public)

## IMPORT POSTMAN COLLECTION
- STEP-1: under docs folder we have a postman collection, please import

## API'S DOCUMENTATION

### APP HEALTH
- URL: GET http://localhost:8000/v1/app/health
- RESPONSE
```json
{
    "status": "OK"
}
```

### CIRCLE
- URL: GET http://localhost:8000/v1/api/geometry/circle/5
- RESPONSE
```json
{
  "type": "circle",
  "radius": 5,
  "surface": 78.53981633974483,
  "diameter": 10
}
```

### TRIANGLE
- URL: GET http://localhost:8000/v1/api/geometry/triangle/5/6/7
- RESPONSE
```json
{
  "type": "triangle",
  "a": 5,
  "b": 6,
  "c": 7,
  "surface": 14.696938456699069,
  "diameter": 7.144345083117603
}
```

### SUM OF AREAS
- URL: POST http://localhost:8000/v1/api/geometry/sum/areas
- PAYLOAD:
```json
{
  "object_1": { // can be a circle or triangle -> let's consider circle
    "radius": 5
  },
  "object_2": { // can be a circle or triangle -> let's consider triangle
    "a": 5,
    "b": 6,
    "c": 7
  }
}
```
- RESPONSE:
```json
{
  "sum_of_areas": 93.2367547964439
}
```

### SUM OF DIAMETERS
- URL: POST http://localhost:8000/v1/api/geometry/sum/diameters
- PAYLOAD:
```json
{
  "object_1": { // can be a circle or triangle -> let's consider circle
    "radius": 5
  },
  "object_2": { // can be a circle or triangle -> let's consider triangle
    "a": 5,
    "b": 6,
    "c": 7
  }
}
```
- RESPONSE:
```json
{
  "sum_of_diameters": 17.144345083117603
}
```