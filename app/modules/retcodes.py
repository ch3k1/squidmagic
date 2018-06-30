def sblcodes():

    SBL_RET_CODES = {
        '127.0.0.2': {
            'status': 'spam',
        },
    }
    return SBL_RET_CODES

def sblzencodes():

    ZEN_RETURN_CODES_SBL = {'127.0.0.2': 'Spam'}
    return ZEN_RETURN_CODES_SBL

def sblcsscodes():
    SBL_CSS_RET_CODES = {
        '127.0.0.3': {
            'status': 'spam',
        },
    }
    return SBL_CSS_RET_CODES

def sblcsszencodes():

    ZEN_RETURN_CODES = {'127.0.0.3': 'Spam'}
    return ZEN_RETURN_CODES

def rblcodes():
    PBL_RET_CODES = {
        '127.0.0.10': {
            'status': 'spam',
        },
        '127.0.0.11': {
            'status': 'spam',
        },
    }
    return PBL_RET_CODES

def zenrblcodes():
    ZEN_RETURN_CODES = {'127.0.0.10': 'Spam', '127.0.0.11': 'Spam'}
    return ZEN_RETURN_CODES

def xblcodes():
    XBL_RET_CODES = {
        '127.0.0.4': {
            'status': 'worms/viruses',
        },
        '127.0.0.5': {
            'status': 'worms/viruses',
        },
        '127.0.0.6': {
            'status': 'worms/viruses',
        },
        '127.0.0.7': {
            'status': 'worms/viruses',
        },
    }
    return XBL_RET_CODES

def zenxblcodes():
    ZEN_RETURN_CODES = {'127.0.0.4': 'worms/viruses', '127.0.0.5': 'worms/viruses',
                        '127.0.0.6': 'worms/viruses', '127.0.0.7': 'worms/viruses'}
    return ZEN_RETURN_CODES
