from configparser import ConfigParser
 
def spamhaus(filename='config.ini', section='spamhaus'):
    parser = ConfigParser()
    parser.read(filename)

    spamhaus = {}
    if parser.has_section(section):
        items = parser.items(section)
        for item in items:
            spamhaus[item[0]] = item[1]
            return item[1]
    else:
        raise Exception('{0} not found in the {1} file'.format(section, filename))
