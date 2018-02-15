@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div style="padding:20px" class="panel panel-default">
                <div class="panel-body">
                    <h2>Quickstart</h2>
                    <p>
                        Here is the basic code on how to use the Samuel API
                    </p>
                    <pre style="padding:30px" class='prettyprint'>{{ $basic_code }}</pre>
                    <p>
                        Dont forget to include your API Key in the link: <strong>{{ config('app.samuel_core') }}?KEY=YOUR_API_KEY</strong>
                    </p>
                    
                    <h2>Parameters</h2>
                    <p>
                        You can add other parameters that are listed below, base on how you want to use the SAMUEL API.
                    </p>
                    <pre style="padding:30px" class='prettyprint'>{{ $set_param }}</pre>
                    <table class='table table-hover'>
                        @foreach($parameters as $param)
                        <tr>
                            <td><strong>{{ $param->param }} @if($param->required) (required) @endif</strong></td>
                            <td>{{$param->data_type}}</td>
                            <td>{{ $param->description }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        
        /* desert scheme ported from vim to google prettify */
        pre.prettyprint { display: block; background-color: #333 }
        pre .nocode { background-color: none; color: #000 }
        pre .str { color: #ffa0a0 } /* string  - pink */
        pre .kwd { color: #f0e68c; font-weight: bold }
        pre .com { color: #87ceeb } /* comment - skyblue */
        pre .typ { color: #98fb98 } /* type    - lightgreen */
        pre .lit { color: #cd5c5c } /* literal - darkred */
        pre .pun { color: #fff }    /* punctuation */
        pre .pln { color: #fff }    /* plaintext */
        pre .tag { color: #f0e68c; font-weight: bold } /* html/xml tag    - lightyellow */
        pre .atn { color: #bdb76b; font-weight: bold } /* attribute name  - khaki */
        pre .atv { color: #ffa0a0 } /* attribute value - pink */
        pre .dec { color: #98fb98 } /* decimal         - lightgreen */

        /* Specify class=linenums on a pre to get line numbering */
        ol.linenums { margin-top: 0; margin-bottom: 0; color: #AEAEAE } /* IE indents via margin-left */
        li.L0,li.L1,li.L2,li.L3,li.L5,li.L6,li.L7,li.L8 { list-style-type: none }
        /* Alternate shading for lines */
        li.L1,li.L3,li.L5,li.L7,li.L9 { }

        @media print {
        pre.prettyprint { background-color: none }
        pre .str, code .str { color: #060 }
        pre .kwd, code .kwd { color: #006; font-weight: bold }
        pre .com, code .com { color: #600; font-style: italic }
        pre .typ, code .typ { color: #404; font-weight: bold }
        pre .lit, code .lit { color: #044 }
        pre .pun, code .pun { color: #440 }
        pre .pln, code .pln { color: #000 }
        pre .tag, code .tag { color: #006; font-weight: bold }
        pre .atn, code .atn { color: #404 }
        pre .atv, code .atv { color: #060 }
        }
    </style>

@endsection
