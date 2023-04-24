let toggleTheme = 0;

function changeMode() {
    if(toggleTheme == 1) {

        document.documentElement.style.setProperty('--ecriture', '#262626');
        document.documentElement.style.setProperty('--color1', '#fcfaff');
        toggleTheme = 0;

    } else {

        document.documentElement.style.setProperty('--ecriture', '#fcfaff');
        document.documentElement.style.setProperty('--color1', '#262626');
        toggleTheme = 1;

    }
}