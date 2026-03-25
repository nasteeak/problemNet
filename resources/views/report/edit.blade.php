<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование заявления</title>
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
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('reports.index') }}" 
                   class="inline-flex items-center gap-2 text-gray-700 dark:text-white 
                          hover:text-gray-900 dark:hover:text-zinc-400 transition-colors">
                    ← Назад к списку
                </a>
            </div>
            
            <div class="bg-zinc-400/70 dark:bg-zinc-800 rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    Редактирование заявления
                </h2>
                
                <form action="{{ route('reports.update', $report->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="number" class="block text-sm font-semibold text-black dark:text-gray-200 mb-2">
                            Номер автомобиля
                        </label>
                        <input placeholder="Номер автомобиля..."
                               type="text" 
                               name="number" 
                               id="number" 
                               value="{{ old('number', $report->number) }}"
                               required
                               class="w-full px-4 py-3 bg-zinc-300/50 dark:bg-zinc-700/50 border border-zinc-200  
                                      dark:border-zinc-900 rounded-lg 
                                      focus:border-transparent 
                                      text-black dark:text-gray-100 placeholder-gray-500
                                      transition-all duration-200">
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-semibold text-black dark:text-gray-200 mb-2">
                            Описание нарушения
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="6"
                                  required
                                  class="w-full px-4 py-3 bg-zinc-300/50 dark:bg-zinc-700/50 border border-zinc-200 
                                         dark:border-zinc-900 rounded-lg 
                                         focus:border-transparent  
                                         text-black dark:text-gray-100 placeholder-gray-500
                                         transition-all duration-200 resize-y">{{ old('description', $report->description) }}</textarea>
                    </div>
                    
                    <button type="submit" 
                            class="px-8 py-3 bg-rose-200/90 hover:bg-rose-300/80 
                                 dark:bg-rose-50 dark:hover:bg-rose-300 dark:text-black
                                   text-black font-semibold rounded-lg transition-all duration-200 
                                   hover:shadow-lg hover:-translate-y-0.5 focus:ring-4 focus:ring-rose-200/90">
                        обновить заявление
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>