For start you need to run:
PHP server and Vite

> php artisan serve
> npm run dev


Fragments:
    Fragments are implemented by Laravel’s Macroable trait.

    Meaning:
    Laravel adds the method at runtime, not in the class file.

    Example how to fix warning
        /** @var \Illuminate\View\View $view */
        $view = view('outline.chapters.index', compact('chapters'));
        return $view->fragment('chapters-list');