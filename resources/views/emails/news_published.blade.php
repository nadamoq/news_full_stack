<x-mail::message>
#hello 


News added recently 📰!


Title :{{$news->title}}


Description :{{$news->description}}

Be the first commenter 

<x-mail::button :url="route('user-view.show', $news->id)">
see news
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
