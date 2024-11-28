<form method="POST" action="{{ $route }}">
    @csrf
    @method('DELETE')
    <a class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
        font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
        href="#" onclick="event.preventDefault();this.closest('form').submit()">
        {{ $text }}
    </a>
</form>