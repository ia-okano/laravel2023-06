<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind サンプル</title>

    {{-- Javascript のビルドツール vite を使って生成されるコードを読み込みする --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- フォント、テキストカラーの設定 --}}
<body class="font-mono text-gray-800">

    {{-- 要素サイズの設定 --}}
    <div class="box-border md:container md:mx-auto">
        {{-- フォントサイズの設定 --}}
        <h1 class="text-4xl">Tailwind サンプル</h1>

        <h2 class="my-8 text-3xl">要素幅の設定</h2>
        <div class="space-y-4">
            <div class="w-96 bg-red-500 shadow rounded">
                w-96
            </div>
            <div class="w-64 bg-indigo-600 shadow rounded">
                w-64
            </div>
            <div class="w-52 text-gray-100 bg-red-700 shadow rounded">
                w-52
            </div>
            <div class="w-28 text-gray-100 bg-red-800 shadow rounded">
                w-28
            </div>
        </div>

        <h2 class="my-8 text-3xl">フォームのレイアウト例</h2>
        <div class="sm:container sm:max-auto">
            <div class="w-400 border-solid border-gray-600 py-4">
                <input type="text" class="border-gray-300 w-120">
                <div class="my-4 flex flex-col flex-start">
                    <label>
                        <input type="checkbox" class="border-gray-300 rounded-sm mr-4">チェックボックス1
                    </label>
                    <label>
                        <input type="checkbox" class="border-gray-300 rounded-sm mr-4">チェックボックス2
                    </label>
                    <label>
                        <input type="checkbox" class="border-gray-300 rounded-sm mr-4">チェックボックス3
                    </label>
                </div>
                <div class="flex">
                    <button class="animate-spin px-4 py-2 bg-green-400 rounded-md drop-shadow-md">送信</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
