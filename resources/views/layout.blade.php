<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta htto-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/styles.css')  }}"> <!-- CSS読み込み -->
        <title>ToDo管理</title>
    </head>
    <body>
        <!-- ヘッダー -->
        <header>
          <h1>ToDo管理</h1>
        </header>
        <!-- メイン -->
        <main>
            <!-- サイドメニュー -->
            <div class="side_menu">
                <ul>
                    <li><i class="icon icon_new"></i><a href="{{ route('create') }}">新規追加</a></li>
                    <!-- <li><i class="icon icon_search"></i><a href="{{ route('list') }}">検索</a></li> -->
                    <li><i class="icon icon_list"></i><a href="{{ route('list') }}">一覧</a></li>
                    <li><i class="icon icon_today"></i><a href="{{ route('today') }}">今日</a></li>
                    <li><i class="icon icon_complete"></i><a href="{{ route('complete') }}">完了</a></li>
                </ul>
            </div>
            <!-- メインコンテンツ -->
            <div class="main_contents" id="contets">
              @yield('main_content')
            </div>
        </main>
        <!-- フッター -->
        <footer>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('/js/script.js')  }}"></script>  <!-- jS読み込み -->
    </body>
</html>