data = { "sending_respon": 
            [
                { 
                    "globalstatus": 10, 
                    "globalstatustext": 
                    "success", 
                    "datapacket": 
                        [
                            { 
                                "packet": 
                                    { 
                                        "number": "6281351673282", 
                                        "sending_id": 42126, 
                                        "sendingstatus": 10, 
                                        "sendingstatustext": "success" 
                                    } 
                            }
                        ] 
                }
            ] 
        };
console.log(data['sending_respon'][0]['globalstatus']);