# D2 - Text Counter (L3)

Using JavaScript or PHP, implement a simple text counter that calculates basic statistics from user-provided text. You should not modify any of the existing code.

**PHP:** Place your server-side logic in `d2/d2-php/api/analyzer.php`

**JS:** Start the server by navigating to the folder and use `node server.js`
**JS:** Place your server-side logic in `d2/d2-js/api/analyzer.js`

## Requirements

Create a server-side solution that:

- Accepts text input via POST request
- Validates that text is provided and non-empty
- Calculates and returns the following metrics:

| Metric              | Description                              |
| ------------------- | ---------------------------------------- |
| `charCount`         | Total character count (including spaces) |
| `charCountNoSpaces` | Character count (excluding spaces)       |
| `wordCount`         | Total number of words                    |

### Response Format

**Success:**

```json
{
  "success": true,
  "analysis": {
    "charCount": 45,
    "charCountNoSpaces": 38,
    "wordCount": 8
  }
}
```

**Error:**

```json
{
  "success": false,
  "message": "Text is required and must be non-empty"
}
```

Please refer to the sample folder and d2-sample.mp4 video.
