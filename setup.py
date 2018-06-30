from setuptools import setup, find_packages
from os import path
from io import open

here = path.abspath(path.dirname(__file__))

with open(path.join(here, 'README.md'), encoding='utf-8') as f:
    long_description = f.read()


requires = [
    'sh',
    'termcolor',
    'configparser',
    'dnspython',
    'pyzmq'
]

setup(
    name='squidmagic',
    version='1.5',
    description='Analyze a web-based network traffic',
    long_description=long_description,
    long_description_content_type='text/markdown',
    url='https://github.com/ch3k1/squidmagic',
    author='Aleksandre V',
    author_email='avardanidze@gmail.com',
    classifiers=[
        'Programming Language :: Python',
        'Programming Language :: Python :: 2',
        'Programming Language :: Python :: 2.7'
    ],
    install_requires=requires,
    packages=find_packages(exclude=['tests']),

    entry_points={  
        'console_scripts': [
            'squidmagic = app.squidmagic:main',
        ],
    },
)
