<!-- filepath: c:\Users\derek\Herd\BBC-duplicate\resources\views\emails\new_post_notification.blade.php -->
<h2>{{ $postTitle }}</h2>
<p class="line-clamp-2">{{ $postBody ?? 'Check out our new post!' }}</p>
<a href="{{ $postUrl }}">Read full post</a>
<p>Thank you for subscribing to our blog!</p>
