<!DOCTYPE html>
<html lang="ja">
    <body>
        <div><span>{{ $reservation->user->name }}</span>様</div>
        <p>本日のご予約情報をお知らせいたします。</p>
        <div>店舗名：<span>{{ $reservation->shop->name }}</span></div>
        <div>日時：<span>{{ $reservation->date }}</span></div>
        <div>時間：<span>{{ substr($reservation->time, 0, 5) }}</span></div>
        <div>人数：<span>{{ $reservation->number }}</span></div>
        <p>ご来店お待ちしております。</p>
    </body>
</html>
