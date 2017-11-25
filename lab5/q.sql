DROP TABLE TEACHES;
DROP TABLE ENROLS;
DROP TABLE REQUIRES;
DROP TABLE INSTRUCTOR;
DROP TABLE COURSE_OFFERING;
DROP TABLE STUDENT;
DROP TABLE COURSE;
 
CREATE TABLE COURSE(
    courseno integer,
    title varchar(300) not null,
    credits integer not null,
    syllabus text,
    primary key(courseno)
);
 
CREATE TABLE REQUIRES(
    main_course integer,
    pre_requisite integer,
    primary key(main_course, pre_requisite),
    foreign key(main_course) references COURSE(courseno),
    foreign key(pre_requisite) references COURSE(courseno)
);
 
CREATE TABLE COURSE_OFFERING(
    courseno integer,
    semester smallint,
    year integer,
    primary key(courseno, semester, year),
    foreign key(courseno) references COURSE(courseno)
);
 
CREATE TABLE STUDENT(
    sid integer,
    name varchar(250),
    primary key(sid)
);
 
CREATE TABLE ENROLS(
    sid integer,
    courseno integer,
    semester smallint,
    year integer,
    grade smallint,
    primary key(sid, courseno, semester, year),
    foreign key(sid) references STUDENT(sid),
    foreign key(courseno, semester, year) references COURSE_OFFERING(courseno, semester, year)
);
 
CREATE TABLE INSTRUCTOR(
    id integer,
    name varchar(250),
    department varchar(250),
    primary key(id)
);
 
CREATE TABLE TEACHES(
    id integer,
    courseno integer,
    semester smallint,
    year integer,
    primary key(id, courseno, semester, year),
    foreign key(id) references INSTRUCTOR(id),
    foreign key(courseno, semester, year) references COURSE_OFFERING(courseno, semester, year)
);
