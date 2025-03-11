# SmartStu - Text Generation with Markov Chains

SmartStu is a web application that generates creative text using Markov chain algorithms. It can produce unique text that mimics the style and patterns of various input sources.

## Features

- Generate text based on custom input or pre-loaded sample texts
- Adjust the "order" parameter to control how closely the output matches the input patterns
- Choose from various sample texts including pop lyrics, rap lyrics, poetry, and country music
- Control the length of generated text
- Simple and intuitive web interface

## How It Works

SmartStu uses Markov chains to analyze patterns in text and generate new content that follows similar patterns. The "order" parameter determines how many characters the algorithm looks at when deciding what comes next, with higher values producing output more similar to the original text.

## Sample Texts

The application comes with several pre-loaded text samples:
- Pop lyrics
- Rap lyrics
- Poetry
- Country music lyrics
- And more in the `text/` directory

## Usage

1. Open the application in your web browser
2. Choose a sample text or paste your own
3. Set the desired order (1-20) and length
4. Click "Generate" to create your text

## Technical Details

- Built with PHP
- Core Markov chain implementation in `markov.php`
- Web interface in `index.php`
- MIT licensed