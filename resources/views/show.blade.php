<!-- resources/views/posts/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <p class="text-base leading-relaxed mb-6">{{ $post->content }}</p>
        <div class="flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">Back to all posts</a>
            <a href="{{ route('posts.edit', $post->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828zM4 12v4h4l10-10-4-4L4 12z" />
                </svg>
                Edit
            </a>
        </div>
    </div>
</body>
</html>
