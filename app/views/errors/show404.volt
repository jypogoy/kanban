
{#{ content() }#}

<div class="ui segment">
    <h1 class="ui huge header">Page not found</h1>
    <p>Sorry, you have accessed a page that does not exist or was moved.</p>
    <p>{{ link_to('', 'Home', 'class': 'ui primary button') }}</p>
</div>