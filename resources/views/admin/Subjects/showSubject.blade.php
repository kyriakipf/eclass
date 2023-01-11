@extends('layouts.admin')
@section('stylesheets')
    <link rel="stylesheet" href="{{asset("css/subjectAdd.css")}}">
@endsection
@section('header')
    teacher dashboard
@endsection
@section('content')
    <div class="mainInfo">
        <div class="top-section row">
            <div class=" main-info flex justify-start align-baseline">
                <div class="col-md-auto">
                    <div class="flex">
                        <p class="title" style="margin-bottom: 0 !important;">{{$subject->title}} </p>
                        <p class="smallTitle mt-2">&ensp; {{$subject->semester->number}}<small>o</small> Εξάμηνο</p>
                    </div>
                    <p class="paragraph mt-1">
                        @foreach($users as $user)
                            {{$user->user->name}} {{$user->user->surname}}
                        @endforeach
                        @if($subject->isPublic)
                            | Κωδικός Μαθήματος: {{$subject->password}}
                        @endif
                    </p>
                </div>
                <div class="col-md-1 ml-auto">
                    <a href="{{route('admin.subjects')}}">Επιστροφή</a>
                </div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="row">
                <div class="flex mt-3">
                    <div class="summary">
                        <p class="subtitle">Περιγραφή</p>
                        @if($subject->summary != null)
                            <p class="paragraph collapsable">{{$subject->summary}} Bacon ipsum dolor amet proident
                                porchetta
                                tail
                                mollit bresaola bacon enim rump t-bone. Pastrami beef ribs ut capicola hamburger,
                                venison laborum tongue aliqua pork loin turducken pork chop porchetta pig chuck. Spare
                                ribs brisket veniam id voluptate lorem ham et flank cupidatat meatloaf short ribs tail
                                capicola. In do ground round kevin, ad ut fatback beef ribs commodo jerky tenderloin et
                                chislic id bresaola. Excepteur deserunt magna nostrud salami chicken officia consequat
                                beef ribs ut strip steak dolore. Ipsum in eiusmod chislic drumstick adipisicing
                                excepteur meatloaf spare ribs pork quis.

                                Filet mignon t-bone tri-tip landjaeger duis tempor, porchetta aliqua bresaola laboris
                                ullamco ham hock ad anim capicola. Strip steak pariatur venison capicola, pork chop
                                commodo aliquip laboris bresaola shankle picanha meatball flank. Enim ipsum boudin, ea
                                tongue turducken buffalo id ad eiusmod in cupim. Boudin shoulder drumstick, chislic
                                flank ham ham hock shankle frankfurter ground round meatball. Reprehenderit biltong qui,
                                laborum eu pariatur drumstick tri-tip.

                                Adipisicing cupidatat reprehenderit ground round consectetur, laboris et. Qui non
                                pancetta, venison sirloin landjaeger proident kielbasa ham dolore ex beef ribs tri-tip
                                hamburger porchetta. Meatloaf commodo hamburger culpa venison ut ullamco tenderloin
                                dolore. Bresaola brisket salami occaecat turducken, sint tail.

                                Velit shoulder fugiat, anim biltong cupidatat chicken. Short loin veniam ut ut, esse
                                irure anim burgdoggen deserunt fugiat ipsum porchetta aliqua. Proident et commodo
                                fatback tail. Picanha qui sausage, meatball strip steak eu officia turkey brisket ex ut
                                consectetur ham.

                                Ground round ipsum officia in ut est. Ut meatball pancetta pork do ham occaecat.
                                Cupidatat prosciutto in pastrami. Duis ut pig, eu deserunt hamburger dolore chuck
                                cupidatat short ribs corned beef kielbasa. Picanha tri-tip eu quis dolore shank.

                                Turducken consequat tenderloin, veniam ex meatloaf frankfurter kevin in cupidatat sunt
                                jowl beef ribs. Est biltong hamburger laboris, pork loin cupim id pork belly labore in.
                                Burgdoggen pork chop ea laborum quis commodo irure lorem eu rump est bresaola do spare
                                ribs. Rump beef ribs burgdoggen, tenderloin pancetta adipisicing shankle buffalo spare
                                ribs eu labore officia aute frankfurter. Nulla tenderloin aliqua tri-tip doner ham hock,
                                tongue kielbasa t-bone burgdoggen frankfurter shankle shank. Eiusmod sed adipisicing
                                meatball.</p>
                            <span class="show-more">Περισσότερα...</span>
                            <span class="show-less">Λιγότερα...</span>
                        @else
                            <p class="paragraph">Δεν υπάρχει διαθέσιμη περιγραφή.</p>
                        @endif
                    </div>
                </div>
                <div class="mt-5">
                    @if($files != null)
                        <a href="{{route('admin.subject.file.show', ['subject' => $subject])}}"
                           class=" button bold">Έγγραφα
                            Μαθήματος</a>
                    @else
                        <p>Δεν υπάρχουν διαθέσιμα έγγραφα</p>
                    @endif
                </div>

                {{--                    <h3>Φακέλοι</h3>--}}
                {{--                    @foreach($folders as $folder)--}}
                {{--                        <a href="{{route('admin.subject.directory.show', ['subject' => $subject ,'folder' => basename($folder)])}}">{{basename($folder)}}</a>--}}
                {{--                    @endforeach--}}
                {{--                </div>--}}
                {{--                <div class="groups">--}}
                {{--                    <h3>Ομάδες</h3>--}}
                {{--                    @if(count($subject->groups) != 0)--}}
                {{--                        @foreach($subject->groups as $group)--}}
                {{--                            <div class="group-info">--}}
                {{--                                <a href="{{route('admin.group.show' ,['group' => $group])}}">{{$group->title}}</a>--}}
                {{--                            </div>--}}
                {{--                        @endforeach--}}
                {{--                    @endif--}}
                {{--                </div>--}}
                {{--                <div class="homework">--}}
                {{--                    <h3>Εργασίες</h3>--}}
                {{--                    @foreach($homeworks as $homework)--}}
                {{--                        <div>--}}
                {{--                            <a href="{{route('admin.homework.show' , ['homework' => $homework])}}">{{$homework->title}}</a>--}}
                {{--                        </div>--}}
                {{--                    @endforeach--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
@endsection

@section('javascripts')
    <script>
        const s = $.noConflict();
        s(document).ready(function () {
            s('.collapsable').css({"maxHeight": "100px"})
            s('.show-less').hide()
            s('.show-more').on('click', function () {
                s('.collapsable').css({"maxHeight": "unset"})
                s('.show-more').hide()
                s('.show-less').show()
            })
            s('.show-less').on('click', function () {
                s('.collapsable').css({"maxHeight": "100px"})
                s('.show-more').show()
                s('.show-less').hide()
            })
        });
    </script>
@endsection
