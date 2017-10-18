<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currency Converter</title>
    <style>
        .wrapper {
            width: 400px;
            height: 100px;

            position: absolute;
            top:-50px;
            bottom: 0;
            left: 0;
            right: 0;

            margin: auto;
        }
            .history {
                margin-bottom:10px;
            }
    </style>
    <script>
        'use strict'
        window.onload=ready

        function ready()
        {
            const form = document.querySelector('form')

            form.addEventListener('submit', event => {
                event.preventDefault()
                const formData = new FormData(form)
                const amount = document.querySelector('#amount')
                if(is_number(amount.value)) {
                    ajax_request(formData)
                } else {
                    alert('Wrong data')
                }
            })

            function is_number(num) 
            {
              return !isNaN(parseFloat(num)) && isFinite(num)
            }

            function ajax_request(form_data)
            {
                var xmlHttp = new XMLHttpRequest()
                xmlHttp.onreadystatechange = function()
                {
                        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                        {
                            const history = JSON.parse(this.responseText).history
                            
                            assign_history(history)
                        }
                }
                xmlHttp.open(form.getAttribute('method'), form.getAttribute('action')) 
                xmlHttp.send(form_data) 
            }

            function assign_history(history)
            {
               const html = history.map((element)=>`<span>\`\`\`${element.from} ${element.amount} - ${element.result} ${element.to} \`\`\`</span></br>`).join('')

               document.querySelector(".history").innerHTML = html
            }
           

            const history_list = {!! json_encode($histories, JSON_UNESCAPED_SLASHES ) !!}
            assign_history(history_list)

        }

        function swap_currency()
        {
            const from = document.getElementById('from')
            const to =  document.getElementById('to')
            const from_index = from.selectedIndex
            const to_index = to.selectedIndex
            
            from.getElementsByTagName('option')[to_index].selected = 'selected'                
            to.getElementsByTagName('option')[from_index].selected = 'selected'                
        }

    </script>
</head>
<body>
    <div class="wrapper">
        <div class="history"></div>
        <div class="manage">
            <form action="{{ route('convertor.convert') }}" method="POST">
                {{csrf_field()}}
                <input type="text" name="amount" required id="amount">
                <select name="from" id="from">
                    @foreach ($currency_list as $currency)
                        <option>{{$currency}}</option>
                    @endforeach
                </select>
                <input type="button" value="↔" onclick="swap_currency()">
                <select name="to" id="to" >
                    @foreach ($currency_list as $currency)
                        <option>{{$currency}}</option>
                    @endforeach
                </select>
                <input type="submit" value="Convert">
            </form>
        </div>
    </div>
</body>
</html>