<div class="relative" x-data="{open:false}" @click.outside="open=false">
    <div @click="open=!open">
        {{$button}}
    </div>
    <div x-cloak x-show="open" x-collapse class="absolute px-2 w-max rounded-md left-0 bg-white dark:bg-dark-eval-3 shadow dark:shadow-slate-600 z-20">
        {{$options}}
    </div>
</div>