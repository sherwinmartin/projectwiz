function fdisabledDays(date)
{
    var m= date.getMonth(), d = date.getDate(), y= date.getFullYear();

    for (i=0; i<disabledDays.length; i++)
    {
        if ($.inArray((m+1)+'-'+d+'-'+y, disabledDays) == -1)
        {
            return [true];
        }else{
            return [false];
        }
    }
}