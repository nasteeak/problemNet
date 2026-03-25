<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница заявлений</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-rose-200/90 text-black dark:text-white dark:bg-rose-950/90 transition-colors duration-300">

    <header class="bg-zinc-400/70 dark:bg-zinc-800 shadow-lg mb-8">
        <div class="container mx-auto px-4 py-4 max-w-7xl">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl md:text-3xl font-bold">
                    НАРУШЕНИЙ.НЕТ
                </h1>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <a href="{{ route('reports.create') }}"
            class="inline-block px-6 py-3 bg-zinc-400/70 hover:bg-zinc-500/70 
                  text-black dark:bg-rose-50 dark:hover:bg-rose-300 dark:text-black font-medium rounded-lg mb-6 transition-all duration-200 
                  hover:shadow-lg hover:-translate-y-0.5">
            создать заявление
        </a>

        <div class="mb-6 space-y-4">
            <div class="flex flex-wrap gap-3 items-center">
                <span class="text-gray-700 dark:text-gray-300 font-medium">Сортировка:</span>

                <a href="{{ route('reports.index', array_merge(request()->query(), ['sort' => 'desc'])) }}"
                    class="px-4 py-2 bg-zinc-400/70 hover:bg-zinc-500/70 
                  dark:bg-rose-50 dark:hover:bg-rose-300 
                  text-black dark:text-black font-medium rounded-lg 
                  transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5
                  {{ request('sort') == 'desc' || !request('sort') ? 'ring-2 ring-rose-500 dark:ring-rose-400' : '' }}">
                    сначала новые
                </a>

                <a href="{{ route('reports.index', array_merge(request()->query(), ['sort' => 'asc'])) }}"
                    class="px-4 py-2 bg-zinc-400/70 hover:bg-zinc-500/70 
                  dark:bg-rose-50 dark:hover:bg-rose-300 
                  text-black dark:text-black font-medium rounded-lg 
                  transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5
                  {{ request('sort') == 'asc' ? 'ring-2 ring-rose-500 dark:ring-rose-400' : '' }}">
                    сначала старые
                </a>
            </div>

            <div class="flex flex-wrap gap-3 items-center">
                <span class="text-gray-700 dark:text-gray-300 font-medium">Фильтр по статусу:</span>

                <a href="{{ route('reports.index', array_merge(request()->query(), ['status' => ''])) }}"
                    class="px-4 py-2 bg-zinc-400/70 hover:bg-zinc-500/70 
                  dark:bg-rose-50 dark:hover:bg-rose-300 
                  text-black dark:text-black font-medium rounded-lg 
                  transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5
                  {{ !request('status') ? 'ring-2 ring-rose-500 dark:ring-rose-400' : '' }}">
                    все
                </a>

                @foreach($statuses as $statusItem)
                <a href="{{ route('reports.index', array_merge(request()->query(), ['status' => $statusItem->id])) }}"
                    class="px-4 py-2 bg-zinc-400/70 hover:bg-zinc-500/70 
                  dark:bg-rose-50 dark:hover:bg-rose-300 
                  text-black dark:text-black font-medium rounded-lg 
                  transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5
                  {{ request('status') == $statusItem->id ? 'ring-2 ring-rose-500 dark:ring-rose-400' : '' }}">
                    {{ $statusItem->name }}
                </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($reports as $report)
            <div class="bg-zinc-400/70 dark:bg-zinc-800
                        rounded-xl shadow-md hover:shadow-xl transition-all duration-300 
                        hover:-translate-y-1 p-5">

                <div class="text-black dark:text-white text-sm mb-2">
                    {{ $report->created_at->format('d.m.Y') }}
                </div>

                <div class="font-bold text-black dark:text-white mb-3">
                    {{ $report->number }}
                </div>

                <div class="text-gray-700 dark:text-gray-300 text-sm  mb-4">
                    {{ Str::limit($report->description, 150) }}
                </div>

                <div class="text-sm text-gray-700 dark:text-gray-300 mb-4">
                    Статус:
                    <span class="font-medium 
                        @if($report->status->name == 'подтверждено') text-teal-600 
                        @elseif($report->status->name == 'отклонено') text-rose-600 
                        @else text-sky-600 
                        @endif">
                        {{ $report->status?->name }}
                    </span>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('reports.edit', $report->id) }}"
                        class="px-4 py-2 bg-rose-200/80 hover:bg-rose-100/80 text-black
                              dark:bg-rose-50 dark:hover:bg-rose-300 dark:text-black text-sm 
                              font-medium rounded-lg transition-colors duration-200">
                        Редактировать
                    </a>

                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Удалить"
                            class="px-4 py-2 bg-rose-300/80 hover:bg-rose-400/50   
                                      text-black  dark:bg-rose-900/70 dark:hover:bg-rose-800 dark:text-black
                                      text-sm font-medium rounded-lg cursor-pointer 
                                      transition-colors duration-200">
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-8 flex justify-center">
            <style>
                .text-sm.text-gray-700.leading-5 {
                    display: none !important;
                }
            </style>
            {{ $reports->appends(request()->query())->links() }}
        </div>
    </div>
</body>

</html>