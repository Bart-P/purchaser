export function capitalizeWord(word) {
    if (word) {
        return word.charAt(0).toUpperCase() + word.slice(1)
    }
}

export function dateToDMY(date) {
    if (date) {
        return new Date(date).toLocaleString('de').slice(0, -10)
    }
}

export function dateToDMYHM(date) {
    if (date) {
        return new Date(date).toLocaleString('de').slice(0, -3)
    }
}

export const allStatus = {
    'de': {
        'created': 'erstellt',
        'send': 'gesendet',
        'waiting': 'warte',
        'done': 'fertig',
        'closed': 'geschlossen'
    },
}

export function getStatusForLang(status, lang) {
    return allStatus[lang][status]
}