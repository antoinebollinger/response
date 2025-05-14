# Abollinger\Response

**Abollinger\Response** is a lightweight PHP utility class that provides a consistent and structured way to format and send API responses in JSON. It simplifies the process of setting HTTP status codes, success flags, messages, and response data — all while supporting CORS headers and clean output handling.

## Features

- **Consistent API Responses**: Set and retrieve standard response fields including `code`, `success`, `message`, `state`, and `data`.
- **Fluent Interface**: Chain methods for clean and expressive response configuration.
- **CORS Headers**: Automatically includes standard CORS headers in every JSON response.
- **Safe Output**: Proper content type and character encoding headers set for JSON APIs.
- **Reset Capability**: Easily reset response to predefined defaults.

## Requirements

- PHP 7.4 or higher
- Composer autoloading (for dependency resolution, e.g., `Helpers::defaultParams()`)

## Installation

Include the `Response` class via Composer autoloading. Ensure you have the required `Helpers` class available in your project.

```bash
composer require abollinger/helpers
```

Then, load the class in your code:

```php
require_once 'vendor/autoload.php';

use Abollinger\Response;
```

## Usage

### Initialization

```php
$response = new Response();
```

### Set and Send a Basic Response

```php
$response
    ->setCode(200)
    ->setSuccess(true)
    ->setMessage("Data fetched successfully.")
    ->setData(['item1', 'item2', 'item3'])
    ->sendJSON();
```

### Use Fluent Method Chaining

```php
$response
    ->set([
        'code' => 201,
        'message' => 'Created successfully.',
        'data' => ['id' => 42]
    ])
    ->sendJSON();
```

### Reset to Defaults

```php
$response->reset();
```

## API Reference

### Constructor

`__construct(array $default = [])`

- Initializes the response with default parameters.
- You can override defaults by passing a custom array.

### Methods

#### `sendJSON(bool $terminate = true): void`

Sends the current response as JSON with appropriate headers and optional script termination.

#### `toJson(int $options = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES): string`

Returns the JSON representation of the current response.

#### `set(array $params = []): self`

Merges provided parameters into the current response array.

#### `setCode(int $code): self`

Sets the HTTP response code.

#### `setSuccess(bool $success): self`

Sets the success flag.

#### `setMessage(string $message): self`

Sets the human-readable message.

#### `setState(int $state): self`

Sets a numeric state identifier.

#### `setData(array|string $data): self`

Sets the payload data of the response.

#### `get(): array`

Returns the entire response array.

#### `getCode(): int`

Returns the current response code.

#### `getSuccess(): bool`

Returns the success status.

#### `getMessage(): string`

Returns the response message.

#### `getState(): int`

Returns the state code.

#### `getData(): array|string`

Returns the response data.

#### `reset(): array`

Resets the response to its default parameters.

## Example Workflow

```php
use Abollinger\Response;

$response = new Response();

$response
    ->setCode(200)
    ->setSuccess(true)
    ->setMessage("User logged in successfully.")
    ->setData(['token' => 'abc123'])
    ->sendJSON();
```

## License

This library is licensed under the MIT License. For full license details, see the `LICENSE` file distributed with this source code.

## Author

Antoine Bollinger  
Email: abollinger@partez.net

For contributions, issues, or feedback, feel free to reach out or open an issue on the relevant repository.