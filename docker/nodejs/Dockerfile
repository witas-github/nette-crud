FROM node:14.0.0
WORKDIR /var/www/html
RUN ["echo","######### Installing javascript packages #########"]
CMD ["npm","install"]
RUN ["echo","######### Building current development JS files #########"]
CMD ["npm","run","build-dev"]