export default {
    "**/*.php*": [
        "vendor/bin/duster fix"
    ],
    "format": "npx prettier --write resources/",
}
