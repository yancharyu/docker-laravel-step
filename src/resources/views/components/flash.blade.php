{{-- フラッシュメッセージをコンポーネント化 --}}
@if (Session::has('success_message'))
<div class="p-flashMessage js-flashMessage">
    {{ Session::get('success_message') }}
</div>

@php
// 一度表示したフラッシュメッセージは削除
Session::forget('success_message');
@endphp

@endif

@if (Session::has('all_clear'))
<vue-modal>
    <template v-slot:title>{{ __('全てのステージをクリアしました！') }}</template>
    <template v-slot:button>{{ __('閉じる') }}</template>
</vue-modal>
@endif